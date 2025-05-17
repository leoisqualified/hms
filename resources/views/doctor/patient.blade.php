@extends('layouts.app')

@section('title', 'Patient Detail')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Patient Header -->
        <div class="mb-8 bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-indigo-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-bold text-white">{{ $patient->name }}</h2>
                            <p class="text-sm text-indigo-100">Patient ID: {{ $patient->patientRecord->patient_id }}</p>
                        </div>
                    </div>
                    {{-- <div class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                        {{ $patient->age }} years
                    </div> --}}
                </div>
            </div>
            <div class="px-6 py-4 bg-white">
                <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ $patient->email ?? 'No email' }}
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ $patient->phone ?? 'No phone' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Vitals Section -->
        <div class="mb-8 bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Patient Vitals
                </h3>
            </div>
            <div class="px-6 py-4">
                @if ($vitals)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-blue-800">Temperature</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $vitals->temperature }}°C</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-purple-800">Blood Pressure</p>
                            <p class="text-2xl font-bold text-purple-600">{{ $vitals->blood_pressure }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-green-800">Pulse Rate</p>
                            <p class="text-2xl font-bold text-green-600">{{ $vitals->pulse }} bpm</p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <p class="text-sm font-medium text-yellow-800">Weight</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $vitals->weight }} kg</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No vitals recorded</h3>
                        <p class="mt-1 text-sm text-gray-500">Patient vitals have not been recorded yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Request Lab Test Button -->
        <div class="my-4">
            <form action="{{ route('labtests.create', $patient->id) }}" method="GET">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Request Lab Test
                </button>
            </form>
        </div>


        <!-- Prescription Form -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Prescribe Medication
                </h3>
            </div>
            <form action="{{ route('doctor.prescribe', $patient_id) }}" method="POST" class="px-6 py-4">
                @csrf
                <div class="space-y-6">
                    <!-- Consultation Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Consultation Notes</label>
                        <div class="mt-1">
                            <textarea id="notes" name="notes" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-3" placeholder="Enter consultation notes..." required></textarea>
                        </div>
                    </div>

                    <!-- Medications -->
                    <div id="medications-wrapper">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Medications</h4>
                        
                        <div class="medication-group space-y-4 p-4 bg-gray-50 rounded-lg">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Medication #1</label>
                                <div class="mt-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <input type="text" name="medications[0][medication_name]" placeholder="Medication Name" 
                                               class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                                               required>
                                    </div>
                                    <div>
                                        <input type="text" name="medications[0][dosage]" placeholder="Dosage (e.g. 2x daily)" 
                                               class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Medication Button -->
                    <button type="button" onclick="addMedication()" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Another Medication
                    </button>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Complete Prescription
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let medIndex = 1;

    function addMedication() {
        const wrapper = document.getElementById('medications-wrapper');
        const div = document.createElement('div');
        div.classList.add('medication-group', 'space-y-4', 'p-4', 'bg-gray-50', 'rounded-lg', 'mt-4');
        
        div.innerHTML = `
            <label class="block text-sm font-medium text-gray-700">Medication #${medIndex + 1}</label>
            <div class="mt-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <input type="text" name="medications[${medIndex}][medication_name]" placeholder="Medication Name" 
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                           required>
                </div>
                <div>
                    <input type="text" name="medications[${medIndex}][dosage]" placeholder="Dosage (e.g. 2x daily)" 
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-md border"
                           required>
                </div>
            </div>
        `;

        wrapper.insertBefore(div, wrapper.lastElementChild);
        medIndex++;
    }
</script>
@endsection