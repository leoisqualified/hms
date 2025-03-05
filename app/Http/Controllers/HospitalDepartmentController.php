<?php

namespace App\Http\Controllers;

use App\Models\HospitalDepartment;
use App\Http\Requests\StoreHospitalDepartmentRequest;
use App\Http\Requests\UpdateHospitalDepartmentRequest;

class HospitalDepartmentController extends Controller
{
    public function index()
    {
        $departments = HospitalDepartment::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(StoreHospitalDepartmentRequest $request)
    {
        HospitalDepartment::create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department added.');
    }

    public function show(HospitalDepartment $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(HospitalDepartment $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(UpdateHospitalDepartmentRequest $request, HospitalDepartment $department)
    {
        $department->update($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department updated.');
    }

    public function destroy(HospitalDepartment $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department removed.');
    }
}
