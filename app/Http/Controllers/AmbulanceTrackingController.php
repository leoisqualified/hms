<?php

namespace App\Http\Controllers;

use App\Models\AmbulanceTracking;
use App\Http\Requests\StoreAmbulanceTrackingRequest;
use App\Http\Requests\UpdateAmbulanceTrackingRequest;

class AmbulanceTrackingController extends Controller
{
    public function index()
    {
        $ambulances = AmbulanceTracking::all();
        return view('ambulances.index', compact('ambulances'));
    }

    public function create()
    {
        return view('ambulances.create');
    }

    public function store(StoreAmbulanceTrackingRequest $request)
    {
        AmbulanceTracking::create($request->validated());
        return redirect()->route('ambulances.index')->with('success', 'Ambulance tracking added successfully.');
    }

    public function show(AmbulanceTracking $ambulanceTracking)
    {
        return view('ambulances.show', compact('ambulanceTracking'));
    }

    public function edit(AmbulanceTracking $ambulanceTracking)
    {
        return view('ambulances.edit', compact('ambulanceTracking'));
    }

    public function update(UpdateAmbulanceTrackingRequest $request, AmbulanceTracking $ambulanceTracking)
    {
        $ambulanceTracking->update($request->validated());
        return redirect()->route('ambulances.index')->with('success', 'Ambulance tracking updated successfully.');
    }

    public function destroy(AmbulanceTracking $ambulanceTracking)
    {
        $ambulanceTracking->delete();
        return redirect()->route('ambulances.index')->with('success', 'Ambulance tracking deleted successfully.');
    }
}
