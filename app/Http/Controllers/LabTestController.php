<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Http\Requests\StoreLabTestRequest;
use App\Http\Requests\UpdateLabTestRequest;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(LabTest::with(['patient','appointment'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateLabTestRequest $request)
    {
        $labTest = LabTest::create($request->validated());
        return response()->json($labTest, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LabTest $labTest)
    {
        return response()->json($labTest->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLabTestRequest $request, LabTest $labTest)
    {
        $labTest->update($request->validated());
        return response()->json($labTest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabTest $labTest)
    {
        $labTest->delete();
        return response()->json(null, 204);
    }
}
