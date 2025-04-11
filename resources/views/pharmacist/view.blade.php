@extends('layouts.app')

@section('title', 'Patient Prescription')

@section('content')
    <h2 class="text-xl font-bold mb-4">Prescriptions for {{ $patient->name }}</h2>

    <div class="mb-4">
        <h3 class="text-lg font-medium">Prescriptions</h3>
        @forelse ($prescriptions as $prescription)
            <div class="border p-4 mb-4">
                <p><strong>Notes:</strong> {{ $prescription->notes }}</p>
                <h4 class="mt-2 font-semibold">Medications:</h4>
                <ul>
                    @foreach ($prescription->medications as $medication)
                        <li>{{ $medication->name }} ({{ $medication->dosage }})</li>
                    @endforeach
                </ul>
                <p class="mt-2"><strong>Status:</strong> {{ $prescription->status }}</p>

                @if ($prescription->status !== 'dispensed')
                    <form action="{{ route('pharmacist.dispense', $prescription->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Mark as Dispensed
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p>No prescriptions found for this patient.</p>
        @endforelse
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-medium">Payment Status</h3>
        @if ($paymentStatus)
            <p><strong>Payment Status:</strong> {{ $paymentStatus->status }}</p>
        @else
            <p>No payment information available.</p>
        @endif
    </div>
@endsection
