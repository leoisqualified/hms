<?php

namespace App\Http\Controllers;

use App\Models\PharmacyInventory;
use App\Http\Requests\UpdatePharmacyInventoryRequest;
use App\Http\Requests\StorePharmacyInventoryRequest;

class PharmacyInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PharmacyInventory::with(['patient', 'doctor'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacyInventoryRequest $request)
    {
        $inventory = PharmacyInventory::create($request->validated());
        return response()->json($inventory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PharmacyInventory $inventory)
    {
        return response()->json($inventory->load(['patient', 'doctor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePharmacyInventoryRequest $request, PharmacyInventory $inventory)
    {
        $inventory->update($request->validated());
        return response()->json($inventory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PharmacyInventory $inventory)
    {
        $inventory->delete();
        return response()->json(null, 204);
    }
}
