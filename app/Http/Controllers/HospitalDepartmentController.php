<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalDepartment;
use App\Http\Requests\StoreHospitalDepartmentRequest;
use App\Http\Requests\UpdateHospitalDepartmentRequest;

class HospitalDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(HospitalDepartment::with(['patient','appointment'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHospitalDepartmentRequest $request)
    {
        $department = HospitalDepartment::create($request->validated());
        return response()->json($department, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalDepartment $department)
    {
        return response()->json($department->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalDepartmentRequest $request, HospitalDepartment $department)
    {
        $department->update($request->validated());
        return response()->json($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalDepartment $department)
    {
        $department->delete();
        return response()->json(null, 204);
    }
}
