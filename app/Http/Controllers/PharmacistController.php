<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;

class PharmacistController extends Controller
{
    public function index () {
        $prescriptions = Prescription::where('paid', true)->where('dispensed', false)->get();
        return view('pharmacist.dashboard', compact('prescriptions'));
    }

    public function dispenseMedication($id) {
        $prescription = Prescription::findOrFail($id);

        if (!$prescription->paid) {
            return redirect()->route('pharmacist.dashboard')->with('error', 'Payment not verified.');
        }

        $prescription->update(['dispensed' => true]);

        return redirect()->route('pharmacist.dashboard')->with('success', 'Medication dispensed successfully.');
    }
}
