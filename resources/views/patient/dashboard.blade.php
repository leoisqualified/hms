@extends('layouts.app')

@section('title', 'Patient Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        {{-- <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Return to Previous Page
            </a>
        </div> --}}

        <!-- Welcome Header Card -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-xl rounded-2xl overflow-hidden mb-8 transform transition-all hover:shadow-2xl">
            <div class="px-8 py-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-16 w-16 rounded-full bg-white bg-opacity-20 flex items-center justify-center backdrop-filter backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-6">
                            <h2 class="text-3xl font-bold text-white">Welcome, {{ Auth::user()->name }}</h2>
                            <div class="mt-2 flex flex-wrap gap-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                                    Patient ID: {{ optional(Auth::user()->patientRecord)->patient_id ?? 'N/A' }}
                                </span>                                
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 text-white">
                                    Member since {{ Auth::user()->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mt-4 md:mt-0">
                        <a href="{{ route('patient.profile') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 transition duration-150 ease-in-out">
                            Edit Profile
                        </a>
                    </div> --}}
                </div>
                <div class="mt-6 flex flex-wrap gap-6 text-sm text-blue-100">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ Auth::user()->email }}
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ Auth::user()->phone ?? 'Phone not provided' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Enhanced Appointments Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="px-6 py-5">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl p-4 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Appointments</h3>
                                    <p class="text-sm text-gray-500">Upcoming consultations</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $appointmentsCount ?? 0 }} scheduled
                                </span>
                            </div>
                            
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex space-x-3 text-sm">
                                    <div class="flex items-center text-blue-600">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Active</span>
                                    </div>
                                </div>
                                <a href="{{ route('patient.appointments') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150">
                                    View Schedule
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 -mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-100">
                    <div class="text-xs text-gray-500">
                        Next appointment: {{ $nextAppointmentDate ?? 'Not scheduled' }}
                    </div>
                </div>
            </div>

            <!-- Enhanced Medications Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="px-6 py-5">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-100 to-green-50 rounded-xl p-4 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div class="ml-5 flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Medications</h3>
                                    <p class="text-sm text-gray-500">Current prescriptions</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $medicationsCount ?? 0 }} active
                                </span>
                            </div>
                            
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex space-x-3 text-sm">
                                    <div class="flex items-center text-green-600">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Prescribed</span>
                                    </div>
                                </div>
                                <a href="{{ route('patient.medications') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-150">
                                    View Medications
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 -mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-100">
                    <div class="text-xs text-gray-500">
                        Last prescribed: {{ $lastPrescriptionDate ?? 'No records' }}
                    </div>
                </div>
            </div>

            <!-- Enhanced Medical History Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="px-6 py-5">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-gradient-to-br from-red-100 to-red-50 rounded-xl p-4 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-5 flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Medical History</h3>
                                    <p class="text-sm text-gray-500">Comprehensive health records</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $medicalHistoryCount ?? 0 }} records
                                </span>
                            </div>
                            
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex space-x-3 text-sm">
                                    <div class="flex items-center text-green-600">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                        <span>Complete</span>
                                    </div>
                                </div>
                                <a href="{{ route('patient.medical_history') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-150">
                                    View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 -mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-100">
                    <div class="text-xs text-gray-500">
                        Last updated: {{ now()->format('M j, Y') }}
                    </div>
                </div>
            </div>

       

        <!-- Recent Activity -->
        <div class="divide-y divide-gray-200">
            @forelse ($activities as $activity)
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-indigo-100 rounded-full p-2 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">{{ $activity->action }}</p>
                                <span class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">{{ $activity->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-4 text-gray-500 text-sm">
                    No recent activity found.
                </div>
            @endforelse
        </div>        
    </div>
</div>
@endsection