<?php

namespace App\Http\Controllers;

use App\Models\StaffSchedule;
use App\Http\Requests\StoreStaffScheduleRequest;
use App\Http\Requests\UpdateStaffScheduleRequest;

class StaffSchedulerController extends Controller
{
    public function index()
    {
        $schedules = StaffSchedule::all();
        return view('staffschedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('staffschedules.create');
    }

    public function store(StoreStaffScheduleRequest $request)
    {
        StaffSchedule::create($request->validated());
        return redirect()->route('staffschedules.index')->with('success', 'Staff schedule added successfully.');
    }

    public function show(StaffSchedule $staffSchedule)
    {
        return view('staffschedules.show', compact('staffSchedule'));
    }

    public function edit(StaffSchedule $staffSchedule)
    {
        return view('staffschedules.edit', compact('staffSchedule'));
    }

    public function update(UpdateStaffScheduleRequest $request, StaffSchedule $staffSchedule)
    {
        $staffSchedule->update($request->validated());
        return redirect()->route('staffschedules.index')->with('success', 'Staff schedule updated successfully.');
    }

    public function destroy(StaffSchedule $staffSchedule)
    {
        $staffSchedule->delete();
        return redirect()->route('staffschedules.index')->with('success', 'Staff schedule deleted successfully.');
    }
}
