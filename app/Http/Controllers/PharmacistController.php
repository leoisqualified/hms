<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    public function dashboard()
    {
        return view('pharmacist.dashboard');
    }

    public function searchPatient(Request $request)
    {
        $request->validate(['patient_id' => 'required|string']);
        $patient = User::where('patient_id', $request->patient_id)->firstOrFail();
        $prescriptions = $patient->prescriptions()->with('medications')->get();
        $paymentStatus = $patient->payments()->latest()->first();
        return view('pharmacist.view', compact('patient', 'prescriptions', 'paymentStatus'));
    }

    public function markAsDispensed($prescriptionId)
    {
        $prescription = Prescription::findOrFail($prescriptionId);
        $prescription->update(['status' => 'dispensed']);
        return redirect()->back()->with('success', 'Medication dispensed.');
    }

    public function verifyPatient()
    {
        // logic for verifying a patient
        return view('pharmacist.verify-patient');
    }
}
