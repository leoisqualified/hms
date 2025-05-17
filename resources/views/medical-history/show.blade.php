@extends('layouts.app')

@section('title', 'Medical History')

@section('content')
@foreach($groupedByDate as $date => $records)
    <div class="my-8">
        <div class="flex items-center mb-6">
            <div class="flex-shrink-0 bg-white border-2 border-gray-200 rounded-full p-2 mr-4">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
            </h2>
        </div>

        <div class="border-l-2 border-gray-200 ml-7 pl-8 space-y-6">
            @foreach($records as $record)
                @php $item = $record['data']; @endphp

                @if($record['type'] === 'appointment')
                    <!-- Appointment Card -->
                    <div class="relative group">
                        <div class="absolute -left-10 top-4 h-4 w-4 rounded-full bg-blue-500 border-4 border-white shadow-sm"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border-l-4 border-blue-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800">Appointment</h3>
                                    </div>
                                    <p class="mt-1 text-gray-600">With Dr. {{ $item->doctor->name }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $item->created_at->format('g:i A') }}
                                </span>
                            </div>
                            @if($item->notes)
                                <div class="mt-4 bg-blue-50 p-3 rounded-md">
                                    <h4 class="text-sm font-medium text-blue-700 mb-1">Doctor's Notes:</h4>
                                    <p class="text-sm text-blue-800">{{ $item->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                @elseif($record['type'] === 'vital')
                    <!-- Vitals Card -->
                    <div class="relative group">
                        <div class="absolute -left-10 top-4 h-4 w-4 rounded-full bg-green-500 border-4 border-white shadow-sm"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border-l-4 border-green-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800">Vitals Check</h3>
                                    </div>
                                    <p class="mt-1 text-gray-600">Recorded by {{ $item->nurse->name ?? 'Nurse' }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $item->created_at->format('g:i A') }}
                                </span>
                            </div>
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="bg-green-50 p-3 rounded-md">
                                    <p class="text-xs font-medium text-green-700">BLOOD PRESSURE</p>
                                    <p class="text-base font-semibold text-gray-900">{{ $item->blood_pressure }}</p>
                                </div>
                                <div class="bg-green-50 p-3 rounded-md">
                                    <p class="text-xs font-medium text-green-700">TEMPERATURE</p>
                                    <p class="text-base font-semibold text-gray-900">{{ $item->temperature }}°F</p>
                                </div>
                                <div class="bg-green-50 p-3 rounded-md">
                                    <p class="text-xs font-medium text-green-700">PULSE</p>
                                    <p class="text-base font-semibold text-gray-900">{{ $item->pulse }} bpm</p>
                                </div>
                                <div class="bg-green-50 p-3 rounded-md">
                                    <p class="text-xs font-medium text-green-700">Weight</p>
                                    <p class="text-base font-semibold text-gray-900">{{ $item->weight }} kg</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($record['type'] === 'prescription')
                    <!-- Prescription Card -->
                    <div class="relative group">
                        <div class="absolute -left-10 top-4 h-4 w-4 rounded-full bg-purple-500 border-4 border-white shadow-sm"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border-l-4 border-purple-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800">Prescription</h3>
                                    </div>
                                    <p class="mt-1 text-gray-600">Prescribed by Dr. {{ $item->doctor->name }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $item->created_at->format('g:i A') }}
                                </span>
                            </div>
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Medications:</h4>
                                <ul class="space-y-2">
                                    @foreach($item->medications as $med)
                                        <li class="flex items-start">
                                            <svg class="flex-shrink-0 h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="ml-2 text-gray-700">
                                                <span class="font-medium">{{ $med->name }}</span> - {{ $med->dosage }} ({{ $med->frequency }})
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif($record['type'] === 'dispensation')
                    <!-- Dispensation Card -->
                    <div class="relative group">
                        <div class="absolute -left-10 top-4 h-4 w-4 rounded-full bg-yellow-500 border-4 border-white shadow-sm"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border-l-4 border-yellow-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800">Medication Dispensed</h3>
                                    </div>
                                    <p class="mt-1 text-gray-600">By {{ $item->pharmacist->name ?? 'Pharmacist' }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ $item->created_at->format('g:i A') }}
                                </span>
                            </div>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700">Prescription ID</h4>
                                    <p class="text-gray-600">{{ $item->prescription_id }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700">Status</h4>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Fulfilled
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endforeach
@endsection