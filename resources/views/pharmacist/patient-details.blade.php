@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">Patient: {{ $patient->name }} ({{ $patient->patient_id }})</h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold">Payment Status:</h3>
            <p>{{ $payment->status ?? 'No payment record' }}</p>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-2">Prescriptions</h3>

            @forelse ($prescriptions as $prescription)
                <div class="border p-4 rounded mb-4">
                    <p><strong>Medication:</strong> {{ $prescription->medications->pluck('name')->join(', ') }}</p>
                    <p><strong>Status:</strong> {{ $prescription->status }}</p>

                    @foreach($prescription->medications as $med)
                        <form action="{{ route('pharmacist.price', $med->id) }}" method="POST" class="mt-2">
                            @csrf
                            <input type="number" step="0.01" name="price" value="{{ $med->price }}" class="border p-1 mr-2" placeholder="Set price">
                            <button class="bg-green-600 text-white px-3 py-1 rounded">Save Price</button>
                        </form>
                    @endforeach

                    <form action="{{ route('pharmacist.dispense', $prescription->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">Dispense</button>
                    </form>
                </div>
            @empty
                <p>No active prescriptions found.</p>
            @endforelse
        </div>
    </div>
@endsection
