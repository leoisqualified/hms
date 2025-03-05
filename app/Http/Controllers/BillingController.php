<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Http\Requests\StoreBillingRequest;
use App\Http\Requests\UpdateBillingRequest;

class BillingController extends Controller
{
    public function index()
    {
        $bills = Billing::all();
        return view('billing.index', compact('bills'));
    }

    public function create()
    {
        return view('billing.create');
    }

    public function store(StoreBillingRequest $request)
    {
        Billing::create($request->validated());
        return redirect()->route('billing.index')->with('success', 'Billing record added successfully.');
    }

    public function show(Billing $billing)
    {
        return view('billing.show', compact('billing'));
    }

    public function edit(Billing $billing)
    {
        return view('billing.edit', compact('billing'));
    }

    public function update(UpdateBillingRequest $request, Billing $billing)
    {
        $billing->update($request->validated());
        return redirect()->route('billing.index')->with('success', 'Billing record updated successfully.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();
        return redirect()->route('billing.index')->with('success', 'Billing record deleted successfully.');
    }
}
