<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    public function dashboard()
    {
        return view('nurse.dashboard');
    }

    public function searchPatient(Request $request)
    {
        $request->validate(['patient_id' => 'required|string']);
        $patient = User::where('patient_id', $request->patient_id)->first();
        return $patient ? view('nurse.record-vitals', compact('patient')) :
                          redirect()->back()->withErrors(['not_found' => 'Patient not found']);
    }

    public function storeVitals(Request $request, $patientId)
    {
        $request->validate([
            'temperature' => 'required|numeric',
            'blood_pressure' => 'required|string',
            'pulse' => 'required|integer',
            'weight' => 'required|numeric',
        ]);

        $patient = User::where('patient_id', $patientId)->firstOrFail();

        $patient->vitals()->create([
            'nurse_id' => Auth::id(),
            'temperature' => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'pulse' => $request->pulse,
            'weight' => $request->weight,
        ]);

        return redirect()->route('nurse.dashboard')->with('success', 'Vitals recorded.');
    }
}
