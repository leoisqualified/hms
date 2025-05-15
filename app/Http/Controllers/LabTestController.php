<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabTest;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class LabTestController extends Controller
{
    // Doctor views form
    public function create($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return view('labtests.create', compact('patient'));
    }

    // Doctor submits request
    public function store(Request $request, $patientId)
    {
        $request->validate([
            'test_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        LabTest::create([
            'patient_id' => $patientId,
            'doctor_id' => Auth::id(),
            'test_name' => $request->test_name,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('patients.show', $patientId)->with('success', 'Lab test requested.');
    }

    // Lab tech views all
    public function index()
    {
        $labtests = LabTest::with('patient')->latest()->get();
        return view('labtests.index', compact('labtests'));
    }

    // Lab tech views one
    public function show($id)
    {
        $labtest = LabTest::with(['patient', 'doctor'])->findOrFail($id);
        return view('labtests.show', compact('labtest'));
    }

    // Lab tech submits result
    public function update(Request $request, $id)
    {
        $request->validate([
            'result' => 'required|string',
        ]);

        $labtest = LabTest::findOrFail($id);
        $labtest->result = $request->result;
        $labtest->status = 'completed';
        $labtest->save();

        return redirect()->route('labtests.index')->with('success', 'Lab test completed.');
    }
}
