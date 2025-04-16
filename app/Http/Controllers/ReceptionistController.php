<?php

namespace App\Http\Controllers;

use App\Mail\SendCredentialsMail;
use App\Models\ActivityLog;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReceptionistController extends Controller
{
    public function dashboard()
    {
        $patients = User::where('role', 'patient')->with('patientRecord')->paginate(10); 
        return view('receptionist.dashboard', compact('patients'));
    }

    public function showPatientForm()
    {
        return view('receptionist.register-patient');
    }

    public function registerPatient(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        $password = Str::random(8);

        // First create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'patient',
            'password' => Hash::make($password),
        ]);

        // Now create the patient record with generated patient_id
        $patientId = 'PT-' . strtoupper(Str::random(6));
        $user->patient()->create([
            'patient_id' => $patientId,
            // Add any additional fields required in the 'patients' table
        ]);

        // Send credentials to patient
        Mail::to($user->email)->send(new SendCredentialsMail($user->email, $password));

        // Log the activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Registered a new patient',
            'description' => 'Registered patient ' . $user->name . ' (ID: ' . $patientId . ')',
        ]);

        return redirect()->back()->with('success', 'Patient registered successfully with ID: ' . $patientId);
    }


    public function assignDoctor(Request $request)
    {
        // Validate the patient and doctor IDs only, since we will use the current date and time
        $request->validate([
            'patient_id' => 'required|string|exists:patients,patient_id',
            'doctor_id' => 'required|exists:users,id',
        ]);

        // Retrieve the patient record
        $patientRecord = Patient::where('patient_id', $request->patient_id)->first();
        $patient = $patientRecord ? $patientRecord->user : null;
        $doctor = User::find($request->doctor_id);

        // Automatically set appointment date and time to the current date and time
        Appointment::create([
            'patient_id' => $patientRecord->id,  // Use the patient record's ID (not the user's ID)
            'doctor_id' => $doctor->id,
            'appointment_date' => now()->toDateString(),
            'appointment_time' => now()->toTimeString(),
            'status' => 'checked_in',
        ]);        

        // 📝 Log the activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Assigned doctor to patient',
            'description' => 'Assigned Dr. ' . $doctor->name . ' to patient ' . $patient->name . ' (' . $patient->patient_id . ')',
        ]);

        return redirect()->back()->with('success', 'Patient checked in and assigned to doctor.');
    }

    public function viewHistory($patientId)
    {
        $patient = User::where('patient_id', $patientId)->firstOrFail();
        $appointments = $patient->appointments()->with('doctor')->get();
        return view('receptionist.history', compact('patient', 'appointments'));
    }
}
