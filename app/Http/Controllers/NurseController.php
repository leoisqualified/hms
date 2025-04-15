<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
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

        // Find the patient record from the 'patients' table
        $patientRecord = Patient::where('patient_id', $request->patient_id)->first();

        if (!$patientRecord || !$patientRecord->user) {
            return redirect()->back()->withErrors(['not_found' => 'Patient not found']);
        }

        // Get the actual User model through the relationship
        $patient = $patientRecord->user;

        // Get the latest vitals for this patient (if any)
        $lastVitals = $patient->vitals()->latest()->first();

        return view('nurse.record-vitals', compact('patient', 'lastVitals'));
    }

    public function storeVitals(Request $request, $patientId)
    {
        $request->validate([
            'temperature' => 'required|numeric',
            'blood_pressure' => 'required|string',
            'pulse' => 'required|integer',
            'weight' => 'required|numeric',
        ]);

        // Get the actual user via the Patient record
        $patientRecord = Patient::where('patient_id', $patientId)->firstOrFail();
        $patient = $patientRecord->user;

        $patient->vitals()->create([
            'nurse_id' => Auth::id(),
            'temperature' => $request->temperature,
            'blood_pressure' => $request->blood_pressure,
            'pulse' => $request->pulse,
            'weight' => $request->weight,
        ]);

        return redirect()->route('nurse.search-form')->with('success', 'Vitals recorded.');
    }

    
    public function searchPatientForm()
    {
        return view('nurse.search-patient'); // create this Blade file next
    }

    public function showVitals($patientId)
    {
        $patient = User::where('patient_id', $patientId)->firstOrFail();
        $vitals = $patient->vitals()->latest()->get();

        return view('nurse.view-vitals', compact('patient', 'vitals'));
    }
}
