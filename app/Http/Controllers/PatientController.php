<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Http\Request;
use App\Models\User;

class PatientController extends Controller
{
    /**
     * Display a listing of the patients.
     */
    public function index()
    {
        $patients = Patient::with('user')->get();
        return view('patients.index', compact('patients')); // Return the index Blade view
    }

    /**
     * Show the form for creating a new patient.
     */
    public function create()
    {
        $users = User::where('role', 'patient')->get();
        return view('patients.create', compact('users')); // Return the create form view
    }

    /**
     * Store a newly created patient in storage.
     */
    public function store(StorePatientRequest $request)
    {
        Patient::create($request->validated());
        return redirect()->route('patients.index')->with('success', 'Patient added successfully!');
    }

    /**
     * Display the specified patient.
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient')); // Return the show Blade view
    }

    /**
     * Show the form for editing the specified patient.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient')); // Return the edit Blade view
    }

    /**
     * Update the specified patient in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    /**
     * Remove the specified patient from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully!');
    }
}
