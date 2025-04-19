<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog; 
use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $appointments = Appointment::with('patient') // patient is now a User
            ->where('doctor_id', Auth::id())
            ->where('status',  'checked_in')
            ->get();

        // dd(Auth::id(), $appointments);

        return view('doctor.dashboard', compact('appointments'));
    }

    public function viewPatient($patientId)
    {
        $patientRecord = Patient::where('patient_id', $patientId)->firstOrFail();
        $patient = $patientRecord->user;
        $vitals = $patient->vitals()->latest()->first();

        return view('doctor.patient', [
            'patient' => $patient,
            'vitals' => $vitals,
            'patient_id' => $patientId, // pass the ID from the route directly
        ]);
    }


    public function prescribe(Request $request, $patientId)
    {
        $request->validate([
            'notes' => 'required|string',
            'medications' => 'required|array',
            'medications.*.medication_name' => 'required|string',  // Fix: medication_name instead of name
            'medications.*.dosage' => 'required|string',
        ]);

        $doctor = Auth::user();

        // 🔥 FIXED HERE
        $patientRecord = Patient::where('patient_id', $patientId)->firstOrFail();
        $patient = $patientRecord->user;

        $prescription = $patient->prescriptions()->create([
            'doctor_id' => $doctor->id,
            'notes' => $request->notes,
        ]);

        // dd($request->medications);

        foreach ($request->medications as $med) {
            $prescription->medications()->create($med);
        }

        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->where('patient_id', $patient->id)
            ->latest()
            ->first();

        if ($appointment) {
            $appointment->status = 'completed';
            $appointment->save();
        }

        ActivityLog::create([
            'user_id' => $doctor->id,
            'action' => 'Completed appointment',
            'description' => 'Completed appointment and prescribed medication for patient ' . $patient->name . ' (' . $patientRecord->patient_id . ')',
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Prescription saved.');
    }


    public function mySchedules()
    {
        $schedules = DoctorSchedule::where('doctor_id', Auth::id())->get();
        return view('doctor.schedules', compact('schedules'));
    }

}
