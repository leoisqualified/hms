@extends('layouts.app')

@section('title', 'Patient Prescription')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Prescriptions for {{ $patient->name }}</h2>
                <p class="text-gray-600 mt-1">Patient ID: {{ $patient->id }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ url()->previous() }}" class="flex items-center text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Patient List
                </a>
            </div>
        </div>

        <!-- Prescriptions Section -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Prescription History
                </h3>
            </div>
            
            @forelse ($prescriptions as $prescription)
                <div class="border-b border-gray-200 last:border-b-0 px-6 py-4 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex flex-col md:flex-row md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center mb-2">
                                <span class="text-sm font-medium text-gray-500">Prescription #{{ $prescription->id }}</span>
                                <span class="ml-2 px-2 py-1 text-xs rounded-full 
                                    @if($prescription->status === 'dispensed') bg-green-100 text-green-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($prescription->status) }}
                                </span>
                            </div>
                            
                            @if($prescription->notes)
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-3 mb-3 rounded-r">
                                    <p class="text-sm text-gray-700"><strong class="font-medium">Doctor's Notes:</strong> {{ $prescription->notes }}</p>
                                </div>
                            @endif
                            
                            <h4 class="font-medium text-gray-700 mb-2">Medications:</h4>
                            <ul class="space-y-2">
                                @foreach ($prescription->medications as $medication)
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                            <span class="font-medium">{{ $medication->name }}</span>
                                            <span class="text-sm text-gray-600 ml-2">({{ $medication->dosage }})</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        @if ($prescription->status !== 'dispensed')
                            <div class="mt-4 md:mt-0 md:ml-4 flex items-start">
                                <form action="{{ route('pharmacist.dispense', $prescription->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Mark as Dispensed
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No prescriptions found</h3>
                    <p class="mt-1 text-gray-500">This patient doesn't have any prescriptions yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Payment Status Section -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Payment Information
                </h3>
            </div>
            <div class="px-6 py-4">
                @if ($paymentStatus)
                    <div class="flex items-center">
                        <div class="p-3 rounded-full 
                            @if($paymentStatus->status === 'paid') bg-green-100 text-green-600
                            @elseif($paymentStatus->status === 'pending') bg-yellow-100 text-yellow-600
                            @else bg-red-100 text-red-600
                            @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-medium text-gray-800">Status: 
                                <span class="capitalize
                                    @if($paymentStatus->status === 'paid') text-green-600
                                    @elseif($paymentStatus->status === 'pending') text-yellow-600
                                    @else text-red-600
                                    @endif">
                                    {{ $paymentStatus->status }}
                                </span>
                            </h4>
                            @if($paymentStatus->amount)
                                <p class="text-gray-600 mt-1">Amount: ${{ number_format($paymentStatus->amount, 2) }}</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center py-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2 text-gray-500">No payment information available for this patient.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection