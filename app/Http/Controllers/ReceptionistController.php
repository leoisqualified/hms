<?php

namespace App\Http\Controllers;

use App\Mail\SendCredentialsMail;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReceptionistController extends Controller
{
    public function dashboard()
    {
        $patients = User::where('role', 'patient')->paginate(10);
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
        $patientId = 'PT-' . strtoupper(Str::random(6));

        $patient = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'patient',
            'patient_id' => $patientId,
            'password' => Hash::make($password),
        ]);

        // Send credentials
        Mail::to($patient->email)->send(new SendCredentialsMail($patient->email, $password));

        return redirect()->back()->with('success', 'Patient registered successfully with ID: ' . $patientId);
    }

    public function assignDoctor(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|string|exists:users,patient_id',
            'doctor_id' => 'required|exists:users,id',
        ]);

        $patient = User::where('patient_id', $request->patient_id)->first();

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'status' => 'checked_in',
            'date' => now(),
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
