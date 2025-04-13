<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Patient;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $patient = $user->patient;
        $activities = ActivityLog::where('user_id', Auth::id())
                    ->latest()
                    ->take(5) // show latest 5
                    ->get();

        return view('patient.dashboard', compact('patient', 'activities'));
    }

    public function medications()
    {
        $patient = Auth::user()->patient;

        if (!$patient) {
            Log::warning('Patient record not found for user ID ' . Auth::id());
            $medications = collect(); // return empty collection
        } else {
            $medications = $patient->prescriptions()->latest()->get();
        }

        return view('patient.medications', compact('medications'));
    }


    public function appointments()
    {
        $patient = Auth::user()->patient;

        // If patient record is missing, return empty appointments
        if (!$patient) {
            Log::warning('Patient record not found for user ID ' . Auth::id());
            return view('patient.appointments', ['appointments' => collect()]);
        }

        $appointments = $patient->appointments()->with('doctor')->latest()->get();

        return view('patient.appointments', compact('appointments'));
    }

    public function cancelAppointment(Appointment $appointment)
    {
        // Ensure the appointment belongs to the logged-in patient
        if ($appointment->patient_id !== Auth::id()) {
            abort(403);
        }

        // Optional: only allow cancellation if it's still scheduled
        if ($appointment->status !== 'scheduled') {
            return redirect()->back()->with('error', 'Only scheduled appointments can be cancelled.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
    }
}
