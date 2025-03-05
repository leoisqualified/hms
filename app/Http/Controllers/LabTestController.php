<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Http\Requests\StoreLabTestRequest;
use App\Http\Requests\UpdateLabTestRequest;

class LabTestController extends Controller
{
    public function index()
    {
        $tests = LabTest::all();
        return view('labtests.index', compact('tests'));
    }

    public function create()
    {
        return view('labtests.create');
    }

    public function store(StoreLabTestRequest $request)
    {
        LabTest::create($request->validated());
        return redirect()->route('labtests.index')->with('success', 'Test recorded.');
    }

    public function show(LabTest $labtest)
    {
        return view('labtests.show', compact('labtest'));
    }

    public function edit(LabTest $labtest)
    {
        return view('labtests.edit', compact('labtest'));
    }

    public function update(UpdateLabTestRequest $request, LabTest $labtest)
    {
        $labtest->update($request->validated());
        return redirect()->route('labtests.index')->with('success', 'Test updated.');
    }

    public function destroy(LabTest $labtest)
    {
        $labtest->delete();
        return redirect()->route('labtests.index')->with('success', 'Test removed.');
    }
}
