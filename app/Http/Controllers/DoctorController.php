<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Prescription;

class DoctorController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('doctor_id', Auth::id())
                                   ->where('status', 'pending')
                                   ->get();
        return view('doctor.dashboard', compact('appointments'));
    }

    public function completeAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'completed']);

        return redirect()->route('doctor.dashboard')->with('success', 'Appointment marked as completed.');
    }

    public function prescribeMedication($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('doctor.prescribe', compact('appointment'));
    }

    public function storePrescription(Request $request, $id)
    {
        $request->validate([
            'medication' => 'required|string',
            'instructions' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Prescription::create([
            'appointment_id' => $id,
            'medication' => $request->medication,
            'instructions' => $request->instructions,
            'price' => $request->price,
            'paid' => false,
            'dispensed' => false,
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Prescription issued successfully.');
}
}