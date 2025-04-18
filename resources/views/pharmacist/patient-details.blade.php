@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Patient: {{ $patient->name }} ({{ $patient->patientRecord->patient_id }})</h2>
            
            <div class="flex items-center">
                <h3 class="text-lg font-semibold text-gray-700 mr-2">Payment Status:</h3>
                <span class="px-2 py-1 text-sm rounded-full 
                    {{ optional($payment)->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $payment->status ?? 'No payment record' }}
                </span>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Prescriptions</h3>
            @forelse ($prescriptions as $prescription)
                <div class="border border-gray-200 rounded-lg p-5 mb-6 hover:shadow-md transition-shadow">
                    <div class="mb-4">
                        <p class="text-gray-800 font-medium mb-2">Medications:</p>
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach ($prescription->medications as $med)
                                <li>
                                    {{ $med->medication_name }}
                                </li>
                            @endforeach
                        </ul>

                        @php
                            $allPaid = $prescription->medications->every(fn($med) => $med->is_paid);
                        @endphp

                        <p class="text-gray-800 mt-3">
                            <span class="font-medium">Status:</span> 
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $prescription->status === 'dispensed' ? 'bg-green-100 text-green-800' : 
                                ($allPaid ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $prescription->status === 'dispensed' 
                                    ? 'Dispensed' 
                                    : ($allPaid ? 'Fully Paid' : 'Payment Pending') }}
                            </span>
                        </p>
                    </div>
                    @foreach($prescription->medications as $med)
                        <form action="{{ route('pharmacist.price', $med->id) }}" method="POST" class="mt-3 flex items-center">
                            @csrf
                            <input type="number" step="0.01" name="price" value="{{ $med->price }}" 
                                class="border border-gray-300 rounded-l px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-32" 
                                placeholder="Price">
                            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-r transition-colors">
                                Save
                            </button>
                        </form>
                    @endforeach

                    @php
                        $allPaid = $prescription->medications->every(fn($med) => $med->is_paid);
                    @endphp

                    @if ($allPaid)
                        <form action="{{ route('pharmacist.dispense', $prescription->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors">
                                Dispense Medication
                            </button>
                        </form>
                    @else
                        <p class="text-sm text-red-600 mt-4">Cannot dispense until all medications are paid for.</p>
                    @endif
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <p>No active prescriptions found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection