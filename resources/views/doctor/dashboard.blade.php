@extends('layouts.app')

@section('title', 'Doctor Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Doctor Dashboard
                </h1>
                <p class="mt-1 text-sm text-gray-600">Today: {{ now()->format('l, F j, Y') }}</p>
            </div>
            <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm text-gray-500">Appointments</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $appointments->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Checked-in Patients Section -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Checked-in Patients
                </h2>
            </div>

            @if ($appointments->isEmpty())
                <div class="px-4 py-12 sm:px-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No patients checked in</h3>
                    <p class="mt-1 text-sm text-gray-500">There are currently no patients waiting for consultation.</p>
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($appointments as $appointment)
                        <li class="px-4 py-5 sm:px-6 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $appointment->patient->name }}</h3>
                                        <div class="mt-1 flex flex-wrap items-center text-sm text-gray-500">
                                            <span class="mr-3">ID: {{ $appointment->patient->patientRecord->patient_id ?? 'N/A' }}</span>
                                            <span class="mr-3 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $appointment->appointment_time ? \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') : 'N/A' }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                Room {{ $appointment->room_number ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $patientId = optional($appointment->patient->patientRecord)->patient_id;
                                @endphp
                                <div class="mt-4 sm:mt-0">
                                    <a href="{{ route('doctor.view-patient', ['patientId' => $appointment->patient->patientRecord->patient_id]) }}"
                                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Patient
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Additional Doctor Tools Section -->
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <a href="#" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Patient Records</h3>
                        <p class="mt-1 text-sm text-gray-500">Search and view patient medical history</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">New Prescription</h3>
                        <p class="mt-1 text-sm text-gray-500">Create medication orders for patients</p>
                    </div>
                </div>
            </a>

            {{-- <a href="#" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Medical Reports</h3>
                        <p class="mt-1 text-sm text-gray-500">Generate diagnostic reports</p>
                    </div>
                </div>
            </a> --}}

            <a href="{{ route('doctor.schedules') }}" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M5 19h14M5 15h14" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">My Schedules</h3>
                        <p class="mt-1 text-sm text-gray-500">View your working hours and appointments</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection