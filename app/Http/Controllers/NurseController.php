<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NurseController extends Controller
{
    public function dashboard()
    {
        $patients = User::where('role', 'patient')->get();

        return view('nurse.dashboard', compact('patients'));
    }

    public function recordVitals() {
        $patients = User::where('role', 'patient_id')->get();

        return view('nurse.record-vitals', compact('patients'));
    }

    public function storeVitals(Request $request) {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'blood_pressure' => 'required|string',
            'heart_rate' => 'required|integer',
            'temperature' => 'required|numeric',
        ]);

        Vitals::create([
            'patient_id' => $request->patient_id,
            'nurse_id' => Auth::id(),
            'blood_pressure' => $request->blood_pressure,
            'heart_rate' => $request->heart_rate,
            'temperature' => $request->temperature,
        ]);

        return redirect()->route('nurse.record-vitals')->with('Sucsess', 'Vitals Created Successfully');
    }
}
