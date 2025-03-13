<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class PatientController extends Controller
{
    //Patient Dashboard
    public function dashbord() {
        $appointments = Appointment::where('patient_id', auth()->id())->get();
        return view('patient.dashboard', compact('appointments'));
    }

    // public function index() {
    //     $patients = 
    //     return
    // }
}
