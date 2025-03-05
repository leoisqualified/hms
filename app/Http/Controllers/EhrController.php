<?php

namespace App\Http\Controllers;

use App\Models\Ehr;
use App\Http\Requests\StoreEhrRequest;
use App\Http\Requests\UpdateEhrRequest;
use App\Models\Patient;
use App\Models\Doctor;

class EhrController extends Controller
{
    public function index()
    {
        $records = Ehr::with(['patient', 'doctor'])->get();
        return view('ehr.index', compact('records'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('ehr.create', compact('patients', 'doctors'));
    }

    public function store(StoreEhrRequest $request)
    {
        Ehr::create($request->validated());
        return redirect()->route('ehr.index')->with('success', 'EHR record added successfully!');
    }

    public function show(Ehr $ehr)
    {
        return view('ehr.show', compact('ehr'));
    }

    public function edit(Ehr $ehr)
    {
        return view('ehr.edit', compact('ehr'));
    }

    public function update(UpdateEhrRequest $request, Ehr $ehr)
    {
        $ehr->update($request->validated());
        return redirect()->route('ehr.index')->with('success', 'EHR record updated successfully!');
    }

    public function destroy(Ehr $ehr)
    {
        $ehr->delete();
        return redirect()->route('ehr.index')->with('success', 'EHR record deleted successfully!');
    }
}
