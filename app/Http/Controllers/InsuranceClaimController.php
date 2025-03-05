<?php

namespace App\Http\Controllers;

use App\Models\InsuranceClaim;
use App\Http\Requests\StoreInsuranceClaimRequest;
use App\Http\Requests\UpdateInsuranceClaimRequest;

class InsuranceClaimController extends Controller
{
    public function index()
    {
        $claims = InsuranceClaim::all();
        return view('insurance.index', compact('claims'));
    }

    public function create()
    {
        return view('insurance.create');
    }

    public function store(StoreInsuranceClaimRequest $request)
    {
        InsuranceClaim::create($request->validated());
        return redirect()->route('insurance.index')->with('success', 'Claim submitted.');
    }

    public function show(InsuranceClaim $insurance)
    {
        return view('insurance.show', compact('insurance'));
    }

    public function edit(InsuranceClaim $insurance)
    {
        return view('insurance.edit', compact('insurance'));
    }

    public function update(UpdateInsuranceClaimRequest $request, InsuranceClaim $insurance)
    {
        $insurance->update($request->validated());
        return redirect()->route('insurance.index')->with('success', 'Claim updated.');
    }

    public function destroy(InsuranceClaim $insurance)
    {
        $insurance->delete();
        return redirect()->route('insurance.index')->with('success', 'Claim deleted.');
    }
}
