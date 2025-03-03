<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Prescription::with(['patient', 'doctor'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrescriptionRequest $request)
    {
        $prescription = Prescription::create($request->validated());
        return response()->json($prescription, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        return response()->json($prescription->load(['pateint', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrescriptionRequest $request, Prescription $prescription)
    {
        $prescription->update($request->validated());
        return response()->json($prescription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return response()->json(null, 204);
    }
}
