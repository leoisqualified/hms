<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Http\Requests\StoreBillingRequest;
use App\Http\Requests\UpdateBillingRequest;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Billing::with('patient')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillingRequest $request)
    {
        $billing = Billing::create($request->validated());
        return response()->json($billing, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing)
    {
        return response()->json($billing->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillingRequest $request, Billing $billing)
    {
        $billing->update($request->validated());
        return response()->json($billing);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billing $billing)
    {
        $billing->delete();
        return response()->json(null, 204);
    }
}
