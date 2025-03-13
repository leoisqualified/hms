<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacistController extends Controller
{
    public function dashboard() {
        $prescriptions = Prescription::where('status', 'pending')->get();

        return view('pharmacist.dashboard', compact('prescriptions'));
    }
}
