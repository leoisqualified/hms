<?php

namespace App\Http\Controllers;

use App\Models\PharmacyInventory;
use App\Http\Requests\StorePharmacyInventoryRequest;
use App\Http\Requests\UpdatePharmacyInventoryRequest;

class PharmacyInventoryController extends Controller
{
    public function index()
    {
        $medicines = PharmacyInventory::all();
        return view('pharmacy.index', compact('medicines'));
    }

    public function create()
    {
        return view('pharmacy.create');
    }

    public function store(StorePharmacyInventoryRequest $request)
    {
        PharmacyInventory::create($request->validated());
        return redirect()->route('pharmacy.index')->with('success', 'Medicine added to inventory.');
    }

    public function show(PharmacyInventory $pharmacy)
    {
        return view('pharmacy.show', compact('pharmacy'));
    }

    public function edit(PharmacyInventory $pharmacy)
    {
        return view('pharmacy.edit', compact('pharmacy'));
    }

    public function update(UpdatePharmacyInventoryRequest $request, PharmacyInventory $pharmacy)
    {
        $pharmacy->update($request->validated());
        return redirect()->route('pharmacy.index')->with('success', 'Inventory updated.');
    }

    public function destroy(PharmacyInventory $pharmacy)
    {
        $pharmacy->delete();
        return redirect()->route('pharmacy.index')->with('success', 'Medicine removed from inventory.');
    }
}
