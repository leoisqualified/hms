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
            <!-- Appointments Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="px-6 py-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-xl p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-medium text-gray-900">Appointments</h3>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $appointmentsCount ?? 0 }}</p>
                            <a href="{{ route('patient.appointments') }}" class="mt-2 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                View all appointments
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medications Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="px-6 py-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-xl p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-medium text-gray-900">Medications</h3>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $medicationsCount ?? 0 }}</p>
                            <a href="{{ route('patient.medications') }}" class="mt-2 inline-flex items-center text-sm font-medium text-green-600 hover:text-green-500">
                                View all medications
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="px-6 py-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 rounded-xl p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-medium text-gray-900">Medical Reports</h3>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $reportsCount ?? 0 }}</p>
                            <a href="#" class="mt-2 inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-500">
                                View all reports
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
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