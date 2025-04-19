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

        $password = Str::random(8); // You can make this more readable if needed

        // 1. Create the User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'patient',
            'password' => Hash::make($password),
        ]);

        // 2. Create the Patient record
        $patientId = 'PT-' . strtoupper(Str::random(6));

        $patient = Patient::create([
            'user_id' => $user->id,
            'patient_id' => $patientId,
            // add other fields like 'medical_history' => $request->input('medical_history') if needed
        ]);

        // 3. Send credentials email
        Mail::to($user->email)->send(new SendCredentialsMail($user->email, $password));

        // 4. Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Registered a new patient',
            'description' => 'Registered patient ' . $user->name . ' (ID: ' . $patientId . ')',
        ]);

        // 5. Return success
        return redirect()->back()->with('success', 'Patient registered successfully with ID: ' . $patientId);

        // Optional: Uncomment to debug
        // dd(['user' => $user, 'patient' => $patient]);
    }

    public function assignDoctor(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|string|exists:patients,patient_id',
            'doctor_id' => 'required|exists:users,id',
        ]);

        $patientRecord = Patient::where('patient_id', $request->patient_id)->first();
        $patient = $patientRecord ? $patientRecord->user : null;
        $doctor = User::find($request->doctor_id);

        // This line won't be reached until you remove dd()
        Appointment::create([
            'patient_id' => $patientRecord->user_id,
            'doctor_id' => $doctor->id,
            'appointment_date' => now()->toDateString(),
            'appointment_time' => now()->toTimeString(),
            'status' => 'checked_in',
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Assigned doctor to patient',
            'description' => 'Assigned Dr. ' . $doctor->name . ' to patient ' . $patient->name . ' (' . $patient->patient_id . ')',
        ]);

        // $latestAppointment = Appointment::latest()->first();
        // dd($latestAppointment);

        return redirect()->back()->with('success', 'Patient checked in and assigned to doctor.');
    }

    public function viewHistory($patientId)
    {
        $patientRecord = Patient::where('patient_id', $patientId)->firstOrFail();
        $patient = $patientRecord->user;
        return view('receptionist.history', compact('patient', 'patientRecord'));
    }
}
