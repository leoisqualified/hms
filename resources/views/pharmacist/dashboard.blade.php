@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Dashboard Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl mb-3">Pharmacist Dashboard</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Manage patient prescriptions and medication dispensing</p>
        </div>

        <!-- Dashboard Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Verify Patient Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Patient Verification</h2>
                    </div>
                    <p class="text-gray-600 mb-6">Verify patient identity and view their prescriptions.</p>
                    <a href="{{ route('pharmacist.verify') }}" class="block w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                        Verify Patient
                    </a>
                </div>
            </div>

            <!-- Prescription Management Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Prescriptions</h2>
                    </div>
                    <p class="text-gray-600 mb-6">View and manage active prescriptions for dispensing.</p>
                    <a href="#" class="block w-full px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white text-center font-medium rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                        Manage Prescriptions
                    </a>
                </div>
            </div>

            <!-- Inventory Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Inventory</h2>
                    </div>
                    <p class="text-gray-600 mb-6">Check medication stock levels and manage inventory.</p>
                    <a href="#" class="block w-full px-4 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white text-center font-medium rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">
                        View Inventory
                    </a>
                </div>
            </div>

            {{-- <!-- View Medical History Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 11h14M5 15h14M5 19h14" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Patient History</h2>
                    </div>
                    <p class="text-gray-600 mb-4">Enter a patient ID to view their medical history and prescriptions.</p>
                    <form action="{{ route('pharmacist.history') }}" method="GET">
                        <input type="text" name="patient_id" placeholder="Enter Patient ID"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
                        <button type="submit"
                            class="w-full px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md">
                            View History
                        </button>
                    </form>
                </div>
            </div> --}}


            <!-- Quick Actions -->
            <div class="md:col-span-2 lg:col-span-3 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="#" class="p-4 bg-gray-50 rounded-lg text-center hover:bg-gray-100 transition-colors duration-200">
                            <div class="mx-auto p-3 rounded-full bg-blue-100 text-blue-600 w-12 h-12 flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">New Prescription</span>
                        </a>
                        <a href="#" class="p-4 bg-gray-50 rounded-lg text-center hover:bg-gray-100 transition-colors duration-200">
                            <div class="mx-auto p-3 rounded-full bg-yellow-100 text-yellow-600 w-12 h-12 flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Refill Request</span>
                        </a>
                        <a href="#" class="p-4 bg-gray-50 rounded-lg text-center hover:bg-gray-100 transition-colors duration-200">
                            <div class="mx-auto p-3 rounded-full bg-red-100 text-red-600 w-12 h-12 flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Dispose Medication</span>
                        </a>
                        <a href="#" class="p-4 bg-gray-50 rounded-lg text-center hover:bg-gray-100 transition-colors duration-200">
                            <div class="mx-auto p-3 rounded-full bg-green-100 text-green-600 w-12 h-12 flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Generate Report</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection