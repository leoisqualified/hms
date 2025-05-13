<div class="space-y-10">

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500">
            <h3 class="text-sm font-medium text-gray-500">Appointments</h3>
            <p class="text-2xl font-semibold text-gray-900">{{ count($appointments) }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-500">
            <h3 class="text-sm font-medium text-gray-500">Vitals</h3>
            <p class="text-2xl font-semibold text-gray-900">{{ count($vitals) }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-purple-500">
            <h3 class="text-sm font-medium text-gray-500">Prescriptions</h3>
            <p class="text-2xl font-semibold text-gray-900">{{ count($prescriptions) }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-yellow-500">
            <h3 class="text-sm font-medium text-gray-500">Dispensations</h3>
            <p class="text-2xl font-semibold text-gray-900">{{ count($dispensations) }}</p>
        </div>
    </div>

    <!-- Appointments -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Appointments
            </h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($appointments as $appt)
                <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex flex-col sm:flex-row justify-between">
                        <div class="mb-2 sm:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Dr. {{ $appt->doctor->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $appt->created_at->format('l, F j, Y \a\t g:i A') }}</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                            Completed
                        </span>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-1">Notes:</h4>
                        <p class="text-gray-600">{{ $appt->notes ?? 'No notes provided.' }}</p>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    No appointments found.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Vitals -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Vitals
            </h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($vitals as $vital)
                <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Recorded by {{ $vital->nurse->name ?? 'Nurse' }}</h3>
                            <p class="text-sm text-gray-500">{{ $vital->created_at->format('l, F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <p class="text-xs font-medium text-blue-800">BLOOD PRESSURE</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $vital->blood_pressure }}</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="text-xs font-medium text-green-800">TEMPERATURE</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $vital->temperature }}°C</p>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <p class="text-xs font-medium text-purple-800">PULSE</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $vital->pulse }} bpm</p>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg">
                            <p class="text-xs font-medium text-yellow-800">RESPIRATION</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $vital->respiration }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    No vitals recorded.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Prescriptions -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Prescriptions
            </h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($prescriptions as $prescription)
                <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex flex-col sm:flex-row justify-between">
                        <div class="mb-2 sm:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">Dr. {{ $prescription->doctor->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $prescription->created_at->format('l, F j, Y') }}</p>
                        </div>
                        <div class="text-sm text-gray-500">
                            Prescription #{{ $prescription->id }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Medications:</h4>
                        <ul class="space-y-2">
                            @foreach($prescription->medications as $med)
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="ml-2 text-gray-600">
                                        <span class="font-medium">{{ $med->name }}</span> - {{ $med->dosage }} ({{ $med->frequency }})
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    No prescriptions found.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Dispensations -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Dispensations
            </h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($dispensations as $disp)
                <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex flex-col sm:flex-row justify-between">
                        <div class="mb-2 sm:mb-0">
                            <h3 class="text-lg font-medium text-gray-900">{{ $disp->pharmacist->name ?? 'Pharmacist' }}</h3>
                            <p class="text-sm text-gray-500">{{ $disp->created_at->format('l, F j, Y \a\t g:i A') }}</p>
                        </div>
                        <div class="text-sm">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                Fulfilled
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700">Prescription ID</h4>
                                <p class="text-gray-600">{{ $disp->prescription_id }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-700">Dispensed On</h4>
                                <p class="text-gray-600">{{ $disp->created_at->format('M j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    No dispensations found.
                </div>
            @endforelse
        </div>
    </div>

</div>