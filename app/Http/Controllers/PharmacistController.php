<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Medication;
use App\Models\User;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    public function dashboard()
    {
        return view('pharmacist.dashboard');
    }

    public function showVerifyForm()
    {
        return view('pharmacist.verify');
    }

    public function verifyPatient(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|string',
        ]);

        $patientRecord = Patient::where('patient_id', $request->patient_id)->first();

        if (!$patientRecord || !$patientRecord->user) {
            return back()->withErrors(['patient_id' => 'Patient not found']);
        }

        return redirect()->route('pharmacist.patient', $request->patient_id);
    }

    public function viewPatient($patient_id)
    {
        $patientRecord = Patient::where('patient_id', $patient_id)->firstOrFail();
        $patient = $patientRecord->user;

        $prescriptions = $patient->prescriptions()->with('medications')->where('status', '!=', 'dispensed')->get();
        $payment = $patient->payments()->latest()->first();

        return view('pharmacist.patient-details', compact('patient', 'prescriptions', 'payment'));
    }

    public function storePrice(Request $request, Medication $medication)
    {
        $request->validate([
            'price' => 'required|numeric|min:0.01',
        ]);

        $medication->update(['price' => $request->price]);

        return back()->with('success', 'Price set successfully.');
    }

    public function dispense(Prescription $prescription)
    {
        $prescription->update(['status' => 'dispensed']);

        return back()->with('success', 'Prescription dispensed.');
    }
}
