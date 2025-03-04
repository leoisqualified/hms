<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHospitalDepartmentRequest;
use Illuminate\Http\Request;
use App\Models\InsuranceClaim;
use App\Http\Requests\StoreInsuranceClaimRequest;
use App\Http\Requests\UpdateInsuranceClaimRequest;

class InsuranceClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(InsuranceClaim::with(['patient','appointment'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsuranceClaimRequest $request)
    {
        $insurance = InsuranceClaim::create($request->validated());
        return response()->json($insurance, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(InsuranceClaim $insurance)
    {
        return response()->json($insurance->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsuranceClaimRequest $request, InsuranceClaim $insurance)
    {
        $insurance->update($request->validated());
        return response()->json($insurance);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InsuranceClaim $insurance)
    {
        $insurance->delete();
        return response()->json(null, 204);
    }
}
