<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function create() {
        $user = Auth::user();
    
        // Get all doctors
        $doctors = User::whereHas('roles', function($q) {
            $q->where('name', 'doctor');
        })->get();
    
        // Get upcoming appointments for the logged-in patient
        $upcomingAppointments = Appointment::where('patient_id', $user->id)
            ->whereDate('date', '>=', now()) // Only future appointments
            ->orderBy('date', 'asc')
            ->get();
    
        return view('patient.book-appointment', compact('doctors', 'upcomingAppointments'));
    }
    

    public function store(Request $request) {
        $request->validate([
            'doctor_id' => 'required|exists:users_id',
            'date' => 'required|date|after:today',
            'time' => 'required',
        ]);

        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
            'is_paid' => false
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Appointment Booked');
    }
}
