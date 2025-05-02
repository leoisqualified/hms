@extends('layouts.app')

@section('title', 'Medical History')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Medical History for {{ $patient->name }}
    </h1>

    <!-- Appointments -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Appointments</h2>
        @forelse($appointments as $appt)
            <div class="bg-white shadow rounded-lg p-4 mb-3 border">
                <div class="flex justify-between">
                    <span><strong>Doctor:</strong> {{ $appt->doctor->name }}</span>
                    <span class="text-sm text-gray-500">{{ $appt->created_at->format('M d, Y H:i') }}</span>
                </div>
                <p class="text-gray-600 mt-2">{{ $appt->notes ?? 'No notes provided.' }}</p>
            </div>
        @empty
            <p class="text-gray-500">No appointments found.</p>
        @endforelse
    </div>

    <!-- Vitals -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Vitals</h2>
        @forelse($vitals as $vital)
            <div class="bg-white shadow rounded-lg p-4 mb-3 border">
                <div class="flex justify-between">
                    <span><strong>Recorded by Nurse:</strong> {{ $vital->nurse->name ?? 'N/A' }}</span>
                    <span class="text-sm text-gray-500">{{ $vital->created_at->format('M d, Y H:i') }}</span>
                </div>
                <ul class="mt-2 text-gray-600 space-y-1">
                    <li>Blood Pressure: {{ $vital->blood_pressure }}</li>
                    <li>Temperature: {{ $vital->temperature }}</li>
                    <li>Pulse: {{ $vital->pulse }}</li>
                    <li>Respiration: {{ $vital->respiration }}</li>
                </ul>
            </div>
        @empty
            <p class="text-gray-500">No vitals recorded.</p>
        @endforelse
    </div>

    <!-- Prescriptions -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Prescriptions</h2>
        @forelse($prescriptions as $prescription)
            <div class="bg-white shadow rounded-lg p-4 mb-3 border">
                <div class="flex justify-between">
                    <span><strong>Prescribed by:</strong> {{ $prescription->doctor->name }}</span>
                    <span class="text-sm text-gray-500">{{ $prescription->created_at->format('M d, Y H:i') }}</span>
                </div>
                <ul class="mt-2 text-gray-600 space-y-1">
                    @foreach($prescription->medications as $med)
                        <li>{{ $med->name }} - {{ $med->dosage }} ({{ $med->frequency }})</li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p class="text-gray-500">No prescriptions found.</p>
        @endforelse
    </div>

    <!-- Dispensations -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Dispensations</h2>
        @forelse($dispensations as $disp)
            <div class="bg-white shadow rounded-lg p-4 mb-3 border">
                <div class="flex justify-between">
                    <span><strong>Pharmacist:</strong> {{ $disp->pharmacist->name ?? 'N/A' }}</span>
                    <span class="text-sm text-gray-500">{{ $disp->created_at->format('M d, Y H:i') }}</span>
                </div>
                <p class="text-gray-600 mt-2">Prescription ID: {{ $disp->prescription_id }}</p>
            </div>
        @empty
            <p class="text-gray-500">No dispensations found.</p>
        @endforelse
    </div>

    <a href="{{ url()->previous() }}" class="inline-block mt-6 text-blue-600 hover:underline">← Back</a>

</div>
@endsection
