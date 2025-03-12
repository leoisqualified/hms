<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    //Patient Dashboard
    public function dashbord() {
        return view('patient.dashboard');
    }

    // public function index() {
    //     $patients = 
    //     return
    // }
}
