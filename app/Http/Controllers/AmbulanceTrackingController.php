<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AmbulanceTracking;
use App\Http\Requests\StoreAmbulanceTrackingRequest;
use App\Http\Requests\UpdateAmbulanceTrackingRequest;

class AmbulanceTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AmbulanceTracking::with(['patient','appointment'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmbulanceTrackingRequest $request)
    {
        $ambulance = AmbulanceTracking::create($request->validated());
        return response()->json($ambulance, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AmbulanceTracking $ambulance)
    {
        return response()->json($ambulance->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmbulanceTrackingRequest $request, AmbulanceTracking $ambulance)
    {
        $ambulance->update($request->validated());
        return response()->json($ambulance);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmbulanceTracking $ambulance)
    {
        $ambulance->delete();
        return response()->json(null, 204);
    }
}
