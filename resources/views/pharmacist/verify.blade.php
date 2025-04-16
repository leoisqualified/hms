@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Patient Header Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8 border border-gray-100">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $patient->name }}</h1>
                        <p class="text-blue-100">Patient ID: {{ $patient->patient_id }}</p>
                    </div>
                    <div class="mt-3 sm:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $payment->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $payment->status ?? 'No payment record' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-blue-800">Age</h3>
                        <p class="text-lg font-semibold">{{ $patient->age ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-blue-800">Gender</h3>
                        <p class="text-lg font-semibold">{{ $patient->gender ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-blue-800">Last Visit</h3>
                        <p class="text-lg font-semibold">{{ $patient->last_visit ? $patient->last_visit->format('M d, Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prescriptions Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Active Prescriptions</h2>
            </div>

            <div class="p-6">
                @forelse ($prescriptions as $prescription)
                    <div class="border border-gray-200 rounded-lg p-5 mb-6 last:mb-0 hover:shadow-md transition-shadow duration-200">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Prescription #{{ $prescription->id }}</h3>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $prescription->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($prescription->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-3 md:mt-0">
                                <p class="text-sm text-gray-500">Issued: {{ $prescription->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            @foreach($prescription->medications as $med)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $med->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $med->dosage }} • {{ $med->instructions }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold {{ $med->price ? 'text-green-600' : 'text-gray-500' }}">
                                                {{ $med->price ? '$'.number_format($med->price, 2) : 'Not priced' }}
                                            </p>
                                        </div>
                                    </div>

                                    <form action="{{ route('pharmacist.price', $med->id) }}" method="POST" class="mt-3 flex items-center">
                                        @csrf
                                        <div class="relative flex-grow mr-3">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500">$</span>
                                            </div>
                                            <input type="number" step="0.01" min="0" name="price" value="{{ $med->price }}" 
                                                   class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                                   placeholder="0.00">
                                        </div>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                            Update
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex justify-end">
                            <form action="{{ route('pharmacist.dispense', $prescription->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Dispense Prescription
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No active prescriptions</h3>
                        <p class="mt-1 text-gray-500">This patient currently has no active prescriptions.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection