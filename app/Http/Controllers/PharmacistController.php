<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    public function dashboard() {
        $prescriptions = Prescription::where('status', 'pending')->get();

        return view('pharmacist.dashboard', compact('prescriptions'));
    }

    public function prescriptions() {
        $prescriptions = Prescription::with('patient_id', 'doctor_id')->get();

        return view('pharmacist.prescriptions', compact('prescriptions'));
    }
}
