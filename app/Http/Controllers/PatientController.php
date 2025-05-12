<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Appointment;
use App\Models\Medication;
use App\Models\Vitals;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $patient = $user->patientRecord;

        if (!$patient) {
            return redirect()->route('patient.dashboard')->with('error', 'Patient record not found.');
        }

        // Count medications
        $medicationsCount = Medication::whereHas('prescription', function ($query) use ($user) {
            $query->where('patient_id', $user->id);
        })->count();

        // Only count scheduled appointments
        $appointmentsCount = $user->appointments()
                                ->where('status', 'checked_in')
                                ->count();

        // Fetch recent activity logs
        $activities = ActivityLog::where('user_id', $user->id)
                        ->latest()
                        ->take(5)
                        ->get();

        $medicalHistoryCount = Appointment::where('patient_id', $user->id)->count()
        + Vitals::where('patient_id', $user->id)->count()
        + Prescription::where('patient_id', $user->id)->count();

        return view('patient.dashboard', compact('patient', 'activities', 'appointmentsCount', 'medicationsCount', 'medicalHistoryCount'));
    }


    public function appointments()
    {
        $user = Auth::user();
        $patient = $user->patientRecord;

        if (!$patient) {
            Log::warning('Patient record not found for user ID ' . $user->id);
            return view('patient.appointments', ['appointments' => collect()]);
        }

        // Fetch only scheduled appointments
        $appointments = $user->appointments()
                            ->where('status', 'scheduled')
                            ->with('doctor')
                            ->latest()
                            ->get();

        return view('patient.appointments', compact('appointments'));
    }


    public function cancelAppointment(Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::id()) {
            abort(403);
        }

        if ($appointment->status !== 'scheduled') {
            return redirect()->back()->with('error', 'Only scheduled appointments can be cancelled.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
    }

    public function medications()
    {
        $user = Auth::user();

        $medications = Medication::whereHas('prescription', function ($query) use ($user) {
            $query->where('patient_id', $user->id);
        })->with('prescription')->get();

        $totalPrice = $medications->sum('price');

        return view('patient.medications', compact('medications', 'totalPrice'));
    }
}
