@extends('layouts.app')

@section('title', 'Nurse Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Dashboard Header -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center">
                <div class="bg-indigo-100 p-3 rounded-xl mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Nurse Dashboard</h1>
                    <p class="text-sm text-gray-600 mt-1">Welcome back, <span class="font-medium text-indigo-600">{{ Auth::user()->name }}</span></p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-white px-5 py-3 rounded-xl shadow-sm border border-gray-200 flex items-center">
                    <div class="bg-green-100 p-1.5 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Shift Status</p>
                        <p class="text-lg font-semibold text-gray-900">On Duty</p>
                    </div>
                </div>
                <div class="bg-white px-5 py-3 rounded-xl shadow-sm border border-gray-200 flex items-center">
                    <div class="bg-blue-100 p-1.5 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Current Time</p>
                        <p class="text-lg font-semibold text-gray-900">{{ now()->format('h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('nurse.find-patient') }}" class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6 flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Find Patient</h3>
                        <p class="text-sm text-gray-500 mt-1">Search patient records</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6 flex items-center">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Record Vitals</h3>
                        <p class="text-sm text-gray-500 mt-1">Enter patient vitals</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6 flex items-center">
                    <div class="bg-purple-100 p-3 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Medications</h3>
                        <p class="text-sm text-gray-500 mt-1">Manage prescriptions</p>
                    </div>
                </div>
            </a>

            <a href="#" class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6 flex items-center">
                    <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Nursing Tasks</h3>
                        <p class="text-sm text-gray-500 mt-1">View assigned tasks</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Upcoming Tasks Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Upcoming Tasks
                    </h3>
                    <span class="text-sm text-indigo-600 font-medium">3 Pending</span>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900">Administer medication to Room 204</p>
                                    <span class="text-xs font-medium bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">30 min</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Patient: John Doe - Amoxicillin 500mg</p>
                                <div class="mt-2 flex gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Medication</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">High Priority</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900">Check vitals for new admissions</p>
                                    <span class="text-xs font-medium bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full">1 hour</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">3 patients awaiting assessment</p>
                                <div class="mt-2 flex gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">Assessment</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900">Shift handover documentation</p>
                                    <span class="text-xs font-medium bg-gray-100 text-gray-800 px-2 py-0.5 rounded-full">3:00 PM</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Complete patient status reports</p>
                                <div class="mt-2 flex gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">Documentation</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-center border-t border-gray-200">
                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 inline-flex items-center">
                        View all tasks
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Recent Patients Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Recent Patients
                    </h3>
                    <span class="text-sm text-indigo-600 font-medium">2 Active</span>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded mr-2">Room 204</span>
                                        <span class="text-xs text-gray-500">Last seen 30 min ago</span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500 flex items-center">
                                View
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Michael Chen</p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded mr-2">Room 312</span>
                                        <span class="text-xs text-gray-500">Last seen 1 hour ago</span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500 flex items-center">
                                View
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-center border-t border-gray-200">
                    <a href="{{ route('nurse.find-patient') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 inline-flex items-center">
                        Find another patient
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection