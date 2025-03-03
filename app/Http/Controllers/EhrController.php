<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EHR;
use App\Http\Requests\StoreEHRRequest;
use App\Http\Requests\UpdateEHRRequest;

class EhrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(EHR::with(['patient', 'doctor'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEHRRequest $request)
    {
        $ehr = EHR::create($request->validated());
        return response()->json($ehr, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EHR $ehr)
    {
        return response()->json($ehr->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEHRRequest $request, EHR $ehr)
    {
        $ehr->update($request->validated());
        return response()->json($ehr);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EHR $ehr)
    {
        $ehr->delete();
        return response()->json(null, 204);
    }
}
