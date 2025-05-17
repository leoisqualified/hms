<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabTest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LabTestController extends Controller
{
    // Doctor requests a new lab test
    public function create($patientId)
    {
        $patient = User::findOrFail($patientId);
        $labTechnicians = User::where('role', 'labtechnician')->get();
        return view('labtests.create', compact('patient', 'labTechnicians'));
    }

    public function store(Request $request, $patientId)
    {
        $request->validate([
            'test_type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'lab_technician_id' => 'required|exists:users,id',
        ]);

        LabTest::create([
            'doctor_id' => Auth::id(),
            'patient_id' => $patientId,
            'lab_technician_id' => $request->lab_technician_id,
            'test_type' => $request->test_type,
            'notes' => $request->notes,
            'status' => 'pending',
            'requested_at' => now(),
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Lab test requested.');
    }

    // Lab technician Views his lab requests
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'labtechnician') {
            $labtests = LabTest::with(['patient', 'doctor'])
                ->where('lab_technician_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            // default behavior: show all (optional, or just deny access)
            $labtests = LabTest::with(['patient', 'doctor'])
                ->latest()
                ->paginate(10);
        }

        return view('labtests.index', compact('labtests'));
    }

    // Lab technician views a specific lab test
    public function show($id)
    {
        $labtest = LabTest::with(['patient', 'doctor'])->findOrFail($id);
        return view('labtests.show', compact('labtest'));
    }

    // Lab technician submits result
    public function update(Request $request, $id)
    {
        $request->validate([
            'result' => 'required|string',
        ]);

        $labtest = LabTest::findOrFail($id);
        $labtest->result = $request->result;
        $labtest->status = 'completed';
        $labtest->lab_technician_id = Auth::id();
        $labtest->completed_at = now();
        $labtest->save();

        return redirect()->route('labtests.index')->with('success', 'Lab test result submitted.');
    }
}
