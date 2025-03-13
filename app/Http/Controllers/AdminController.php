<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'doctorCount' => User::where('role', 'doctor')->count(),
            'patientCount' => User::where('role', 'patient')->count(),
            'appointmentCount' => Appointment::whereDate('date', today())->count(),
        ]);
    }
}
