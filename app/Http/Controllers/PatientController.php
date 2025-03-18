<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;


class PatientController extends Controller
{
    public function index() {
        $appointments = Appointment::where('patient_id', Auth::id())->orderBy('date', 'asc')->get();
        return view('patient.dashboard', compact('appointments'));
    }
}
