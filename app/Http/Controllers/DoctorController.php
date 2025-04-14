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
        $appointments = Appointment::with(['patient.patientRecord'])->where('doctor_id', Auth::id())->get();
        return view('doctor.dashboard', compact('appointments'));
    }

    public function viewPatient($patientId)
    {
        $patientRecord = Patient::where('patient_id', $patientId)->firstOrFail();
        $patient = $patientRecord->user;
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

    $doctor = Auth::user();
    $patient = User::where('patient_id', $patientId)->firstOrFail();

    $prescription = $patient->prescriptions()->create([
        'doctor_id' => $doctor->id,
        'notes' => $request->notes,
    ]);

    foreach ($request->medications as $med) {
        $prescription->medications()->create($med);
    }

    // ✅ Mark the latest appointment as completed (you could fine-tune this further if needed)
    $appointment = Appointment::where('doctor_id', $doctor->id)
        ->where('patient_id', $patient->id)
        ->latest()
        ->first();

    if ($appointment) {
        $appointment->status = 'completed';
        $appointment->save();
    }

    // 📝 Log the action
    ActivityLog::create([
        'user_id' => $doctor->id,
        'action' => 'Completed appointment',
        'description' => 'Completed appointment and prescribed medication for patient ' . $patient->name . ' (' . $patient->patient_id . ')',
    ]);

    return redirect()->route('doctor.dashboard')->with('success', 'Prescription saved.');
    }

    public function mySchedules()
    {
        $schedules = DoctorSchedule::where('doctor_id', Auth::id())->get();
        return view('doctor.schedules', compact('schedules'));
    }

}
