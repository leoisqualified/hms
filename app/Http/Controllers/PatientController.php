<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $patient = $user->patient;

        return view('patient.dashboard', compact('patient'));
    }

    public function medications()
    {
        $patient = Auth::user()->patient;
        $prescriptions = $patient->prescriptions()->latest()->get();

        return view('patient.medications', compact('prescriptions'));
    }

    public function appointments()
    {
        $patient = Auth::user()->patient;
        $appointments = $patient->appointments()->with('doctor')->latest()->get();

        return view('patient.appointments', compact('appointments'));
    }
}
