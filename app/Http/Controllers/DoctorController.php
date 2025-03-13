<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
class DoctorController extends Controller
{
    public function dashboard() {
        $appointments = Appointment::where('patient_id', Auth::id())->get();
        return view ('doctor.dashboard', compact('appointments'));
    }
}
