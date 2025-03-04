<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Http\Requests\StoreStaffScheduleRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Http\Requests\UpdateStaffScheduleRequest;
use App\Models\StaffSchedule;

class StaffScheduleController extends Controller
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
    public function store(StoreStaffScheduleRequest $request)
    {
        $schedule = Prescription::create($request->validated());
        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StaffSchedule $schedule)
    {
        return response()->json($schedule->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffScheduleRequest $request, StaffSchedule $schedule)
    {
        $schedule->update($request->validated());
        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffSchedule $schedule)
    {
        $schedule->delete();
        return response()->json(null, 204);
    }
}
