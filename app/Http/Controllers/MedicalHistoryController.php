<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Vitals;
use App\Models\Prescription;
use App\Models\Dispensation;
use App\Models\User;


class MedicalHistoryController extends Controller
{
    public function show($patientId)
    {
        // Step 1: Get the patient's user and patient record
        $patientRecord = Patient::where('patient_id', $patientId)->firstOrFail();
        $patient = $patientRecord->user;

        // Step 2: Get all appointments (to track doctors and dates)
        $appointments = Appointment::with('doctor')
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Step 3: Get vitals with nurse details
        $vitals = Vitals::with('nurse')
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Step 4: Get prescriptions with medications and doctor
        $prescriptions = Prescription::with(['doctor', 'medications'])
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Step 5: Get dispensations with pharmacist
        $dispensations = Dispensation::with(['pharmacist', 'prescription'])
            ->whereHas('prescription', function ($q) use ($patient) {
                $q->where('patient_id', $patient->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medical-history.show', compact(
            'patient',
            'patientRecord',
            'appointments',
            'vitals',
            'prescriptions',
            'dispensations'
        ));
    }
}
