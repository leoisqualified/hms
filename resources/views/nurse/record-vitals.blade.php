@extends('layouts.app')

@section('title', 'Record Vitals')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Patient Header -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200 bg-indigo-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold text-white">Record Vitals</h2>
                        <p class="text-sm text-indigo-100">Patient: {{ $patient->name }} (ID: {{ $patient->patientRecord->patient_id }})</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-white">
                <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Last recorded: {{ $lastVitals ? $lastVitals->created_at->diffForHumans() : 'Never' }}
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Doctor: {{ optional($patient->appointments->last()->doctor)->name ?? 'Not assigned' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 mb-6">
            <button id="toggleHistory" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                View Medical History
            </button>
        
            <div id="historySection" class="mt-4 hidden">
                <div id="historyLoader" class="text-gray-500">Loading medical history...</div>
                <div id="historyContent" class="hidden"></div>
            </div>
        </div>
        
        <script>
            document.getElementById('toggleHistory').addEventListener('click', function () {
                const section = document.getElementById('historySection');
                const loader = document.getElementById('historyLoader');
                const content = document.getElementById('historyContent');
        
                if (section.classList.contains('hidden')) {
                    section.classList.remove('hidden');
        
                    fetch("{{ route('nurse.medical-history.partial', ['patientId' => $patient->patientRecord->patient_id]) }}")
                        .then(response => response.text())
                        .then(html => {
                            loader.classList.add('hidden');
                            content.innerHTML = html;
                            content.classList.remove('hidden');
                        });
                } else {
                    section.classList.add('hidden');
                }
            });
        </script>


        <!-- Vitals Form -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Vital Signs
                </h3>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg shadow-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('nurse.store-vitals', $patient->patientRecord->patient_id) }}" method="POST" class="px-6 py-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Temperature -->
                    <div>
                        <label for="temperature" class="block text-sm font-medium text-gray-700">Temperature (°C)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="temperature" id="temperature" step="0.1" required
                                value="{{ old('temperature', $lastVitals->temperature ?? '') }}"
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                            placeholder="36.5 - 37.5">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">°C</span>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Normal range: 36.5°C - 37.5°C</p>
                    </div>

                    <!-- Blood Pressure -->
                    <div>
                        <label for="blood_pressure" class="block text-sm font-medium text-gray-700">Blood Pressure</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="blood_pressure" id="blood_pressure" required
                            value="{{ old('blood_pressure', $lastVitals->blood_pressure ?? '') }}"
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                            placeholder="120/80">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">mmHg</span>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Normal range: 90/60 - 120/80</p>
                    </div>

                    <!-- Pulse -->
                    <div>
                        <label for="pulse" class="block text-sm font-medium text-gray-700">Pulse Rate</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="pulse" id="pulse" required
                            value="{{ old('pulse', $lastVitals->pulse ?? '') }}"
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                            placeholder="60-100">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">bpm</span>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Normal range: 60-100 bpm</p>
                    </div>

                    <!-- Weight -->
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="weight" id="weight" step="0.1" required
                            value="{{ old('weight', $lastVitals->weight ?? '') }}"
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                            placeholder="Weight in kg">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">kg</span>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Fields -->
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <div class="mt-1">       
                            <textarea id="notes" name="notes" rows="3"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2"
                                placeholder="Any additional observations">{{ old('notes', $lastVitals->notes ?? '') }}
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ url()->previous() }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Vitals
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous Vitals (if available) -->
        @if($lastVitals)
        <div class="mt-8 bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Last recorded: {{ $lastVitals ? $lastVitals->created_at->diffForHumans() : 'Never' }}
                </h3>
            </div>
            <div class="px-6 py-4">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-blue-800">Temperature</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $lastVitals->temperature }}°C</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-purple-800">Blood Pressure</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $lastVitals->blood_pressure }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-green-800">Pulse Rate</p>
                        <p class="text-2xl font-bold text-green-600">{{ $lastVitals->pulse }} bpm</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-yellow-800">Weight</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $lastVitals->weight }} kg</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection