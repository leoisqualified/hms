<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Prescription;
class DoctorController extends Controller
{
    public function dashboard() {
        $appointments = Appointment::where('patient_id', Auth::id())->get();
        return view ('doctor.dashboard', compact('appointments'));
    }

    
    public function prescribe(Request $request) {
        $request->validate([
        'patient_id' => 'required|exists:users,id',
        'medications' => 'required|string',
        ]);

        Prescription::create([
        'doctor_id' => Auth::id(),
        'patient_id' => $request->patient_id,
        'medications' => $request->medications,
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Prescription Saved');
    }
}
