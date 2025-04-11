@extends('layouts.app')

@section('title', 'Patient Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200 bg-indigo-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold text-white">Welcome, {{ Auth::user()->name }}</h2>
                            <p class="text-sm text-indigo-100">Patient ID: {{ Auth::user()->patient->patient_id }}</p>
                        </div>
                    </div>
                    <div class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                        Member since {{ Auth::user()->created_at->format('M Y') }}
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-white">
                <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ Auth::user()->email }}
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ Auth::user()->phone ?? 'No phone number provided' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Appointments</dt>
                            <dd class="flex items-baseline">
                                <p class="text-2xl font-semibold text-gray-900">{{ $appointmentsCount ?? 0 }}</p>
                                <a href="{{ route('patient.appointments') }}" class="ml-2 text-sm font-medium text-blue-600 hover:text-blue-500">
                                    View all
                                </a>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Active Medications</dt>
                            <dd class="flex items-baseline">
                                <p class="text-2xl font-semibold text-gray-900">{{ $medicationsCount ?? 0 }}</p>
                                <a href="{{ route('patient.medications') }}" class="ml-2 text-sm font-medium text-green-600 hover:text-green-500">
                                    View all
                                </a>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">Medical Reports</dt>
                            <dd class="flex items-baseline">
                                <p class="text-2xl font-semibold text-gray-900">{{ $reportsCount ?? 0 }}</p>
                                <a href="#" class="ml-2 text-sm font-medium text-purple-600 hover:text-purple-500">
                                    View all
                                </a>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <a href="{{ route('patient.appointments') }}" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 border-l-4 border-blue-500">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Appointments</h3>
                        <p class="mt-2 text-sm text-gray-500">Schedule and manage visits</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('patient.medications') }}" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 border-l-4 border-green-500">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Medications</h3>
                        <p class="mt-2 text-sm text-gray-500">View prescriptions</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 border-l-4 border-purple-500">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Medical Records</h3>
                        <p class="mt-2 text-sm text-gray-500">Access your health history</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 border-l-4 border-indigo-500">
                <div class="px-4 py-5 sm:p-6 flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Support</h3>
                        <p class="mt-2 text-sm text-gray-500">Get help and assistance</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Recent Activity
                </h3>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Appointment confirmed</p>
                            <p class="text-sm text-gray-500">With Dr. Smith on June 15 at 2:00 PM</p>
                        </div>
                        <span class="text-sm text-gray-500">2 days ago</span>
                    </div>
                </div>
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-900">New prescription</p>
                            <p class="text-sm text-gray-500">Amoxicillin 500mg (2x daily for 7 days)</p>
                        </div>
                        <span class="text-sm text-gray-500">1 week ago</span>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 text-center">
                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all activity</a>
            </div>
        </div>
    </div>
</div>
@endsection