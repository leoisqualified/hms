<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
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

            $merged = collect();
            
            foreach ($appointments as $appt) {
                $merged->push([
                    'type' => 'appointment',
                    'date' => $appt->created_at->toDateString(),
                    'data' => $appt,
                ]);
            }
            
            foreach ($vitals as $vital) {
                $merged->push([
                    'type' => 'vital',
                    'date' => $vital->created_at->toDateString(),
                    'data' => $vital,
                ]);
            }
            
            foreach ($prescriptions as $prescription) {
                $merged->push([
                    'type' => 'prescription',
                    'date' => $prescription->created_at->toDateString(),
                    'data' => $prescription,
                ]);
            }
            
            foreach ($dispensations as $disp) {
                $merged->push([
                    'type' => 'dispensation',
                    'date' => $disp->created_at->toDateString(),
                    'data' => $disp,
                ]);
            }
            
            $groupedByDate = $merged->groupBy('date')->sortKeysDesc();
            
            return view('medical-history.show', compact(
                'patient',
                'patientRecord',
                'groupedByDate'
            ));
    }

    public function myHistory()
    {
        $user = Auth::user();

        $patientRecord = $user->patientRecord;

        if (!$patientRecord) {
            abort(404, 'Patient record not found.');
        }

        $patient = $user;

        $appointments = Appointment::with('doctor')
            ->where('patient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $vitals = Vitals::with('nurse')
            ->where('patient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $prescriptions = Prescription::with(['doctor', 'medications'])
            ->where('patient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $dispensations = Dispensation::with(['pharmacist', 'prescription'])
            ->whereHas('prescription', function ($q) use ($user) {
                $q->where('patient_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

            $merged = collect();
            
            foreach ($appointments as $appt) {
                $merged->push([
                    'type' => 'appointment',
                    'date' => $appt->created_at->toDateString(),
                    'data' => $appt,
                ]);
            }
            
            foreach ($vitals as $vital) {
                $merged->push([
                    'type' => 'vital',
                    'date' => $vital->created_at->toDateString(),
                    'data' => $vital,
                ]);
            }
            
            foreach ($prescriptions as $prescription) {
                $merged->push([
                    'type' => 'prescription',
                    'date' => $prescription->created_at->toDateString(),
                    'data' => $prescription,
                ]);
            }
            
            foreach ($dispensations as $disp) {
                $merged->push([
                    'type' => 'dispensation',
                    'date' => $disp->created_at->toDateString(),
                    'data' => $disp,
                ]);
            }
            
            $groupedByDate = $merged->groupBy('date')->sortKeysDesc();
            
            return view('medical-history.show', compact(
                'patient',
                'patientRecord',
                'groupedByDate'
            ));            
    }

    public function partialView($patientId)
    {
        $patientRecord = Patient::where('patient_id', $patientId)->firstOrFail();
        $patient = $patientRecord->user;

        $appointments = Appointment::with('doctor')
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $vitals = Vitals::with('nurse')
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $prescriptions = Prescription::with(['doctor', 'medications'])
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $dispensations = Dispensation::with(['pharmacist', 'prescription'])
            ->whereHas('prescription', function ($q) use ($patient) {
                $q->where('patient_id', $patient->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();


            // Merge and group all records by date
            $merged = collect();
            
            foreach ($appointments as $appt) {
                $merged->push([
                    'type' => 'appointment',
                    'date' => $appt->created_at->toDateString(),
                    'data' => $appt,
                ]);
            }
            
            foreach ($vitals as $vital) {
                $merged->push([
                    'type' => 'vital',
                    'date' => $vital->created_at->toDateString(),
                    'data' => $vital,
                ]);
            }
            
            foreach ($prescriptions as $prescription) {
                $merged->push([
                    'type' => 'prescription',
                    'date' => $prescription->created_at->toDateString(),
                    'data' => $prescription,
                ]);
            }
            
            foreach ($dispensations as $disp) {
                $merged->push([
                    'type' => 'dispensation',
                    'date' => $disp->created_at->toDateString(),
                    'data' => $disp,
                ]);
            }
            
            $groupedByDate = $merged->groupBy('date')->sortKeysDesc();
            
            return view('medical-history.show', compact(
                'patient',
                'patientRecord',
                'groupedByDate'
            ));
            
    }
}
