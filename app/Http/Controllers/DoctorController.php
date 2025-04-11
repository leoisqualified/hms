<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $appointments = Appointment::where('doctor_id', Auth::id())->with('patient')->get();
        return view('doctor.dashboard', compact('appointments'));
    }

    public function viewPatient($patientId)
    {
        $patient = User::where('patient_id', $patientId)->firstOrFail();
        $vitals = $patient->vitals()->latest()->first();
        return view('doctor.patient', compact('patient', 'vitals'));
    }

    public function prescribe(Request $request, $patientId)
    {
        $request->validate([
            'notes' => 'required|string',
            'medications' => 'required|array',
            'medications.*.name' => 'required|string',
            'medications.*.dosage' => 'required|string',
        ]);

        $patient = User::where('patient_id', $patientId)->firstOrFail();

        $prescription = $patient->prescriptions()->create([
            'doctor_id' => Auth::id(),
            'notes' => $request->notes,
        ]);

        foreach ($request->medications as $med) {
            $prescription->medications()->create($med);
        }

        return redirect()->route('doctor.dashboard')->with('success', 'Prescription saved.');
    }
}
