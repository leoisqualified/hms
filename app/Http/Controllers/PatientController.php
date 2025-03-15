<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    
    //Patient Dashboard
    public function dashboard() {
        $appointments = Appointment::where('patient_id', Auth::id())->get();
        return view('patient.dashboard', compact('appointments'));
    }

    // public function index() {
    //     $patients = 
    //     return
    // }
}
