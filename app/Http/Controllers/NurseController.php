<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Vitals;

class NurseController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', 'pending')->get();
        return view('nurse.dashboard', compact('appointments'));
    }

    public function recordVitals($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('nurse.record-vitals', compact('appointment'));
    }

    public function storeVitals(Request $request, $id)
    {
        $request->validate([
            'temperature' => 'required|numeric',
            'blood_pressure' => 'required|string',
            'pulse' => 'required|integer',
            'weight' => 'required|numeric',
        ]);

        Vitals::create([
            'patient_id' => Appointment::findOrFail($id)->patient_id,
            'nurse_id' => Auth::id(),
            'temperature' => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'pulse' => $request->pulse,
            'weight' => $request->weight,
        ]);

        return redirect()->route('nurse.dashboard')->with('success', 'Vitals recorded successfully.');
    }
}
