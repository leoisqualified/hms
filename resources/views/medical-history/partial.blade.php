<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">

    @foreach ($groupedByDate as $date => $records)
        <!-- Date Header -->
        <div class="sticky top-0 z-10 bg-white/90 backdrop-blur-sm py-4 px-5 shadow-sm rounded-xl border border-gray-100 flex items-center">
            <div class="bg-indigo-50 p-2 rounded-lg mr-3">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">
                {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
            </h2>
        </div>

        <!-- Timeline Records -->
        <div class="relative pl-10 ml-1 space-y-5">
            <!-- Timeline line -->
            <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>
            
            @foreach ($records as $record)
                @php $item = $record['data']; @endphp

                @if ($record['type'] === 'appointment')
                    <!-- Appointment Card -->
                    <div class="relative group">
                        <div class="absolute -left-9 top-5 h-4 w-4 rounded-full bg-white border-4 border-blue-500 shadow-sm flex items-center justify-center">
                            <svg class="h-2 w-2 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 p-5 border border-gray-100">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Appointment with Dr. {{ $item->doctor->name }}</h3>
                                            <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('g:i A') }}</p>
                                        </div>
                                    </div>
                                    @if($item->notes)
                                        <div class="mt-3 bg-blue-50/50 p-3 rounded-lg border border-blue-100">
                                            <p class="text-sm text-blue-800">{{ $item->notes }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Completed
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif ($record['type'] === 'vital')
                    <!-- Vitals Card -->
                    <div class="relative group">
                        <div class="absolute -left-9 top-5 h-4 w-4 rounded-full bg-white border-4 border-green-500 shadow-sm flex items-center justify-center">
                            <svg class="h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 4c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1.4c0-2 4-3.1 6-3.1s6 1.1 6 3.1V19z"/>
                            </svg>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 p-5 border border-gray-100">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Vitals Check</h3>
                                            <p class="text-xs text-gray-500 mt-1">Recorded by {{ $item->nurse->name ?? 'Nurse' }} at {{ $item->created_at->format('g:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-3">
                                        <div class="bg-green-50/50 p-3 rounded-lg border border-green-100">
                                            <p class="text-xs font-medium text-green-700 uppercase tracking-wider">Blood Pressure</p>
                                            <p class="text-sm font-semibold mt-1">{{ $item->blood_pressure }}</p>
                                        </div>
                                        <div class="bg-green-50/50 p-3 rounded-lg border border-green-100">
                                            <p class="text-xs font-medium text-green-700 uppercase tracking-wider">Temperature</p>
                                            <p class="text-sm font-semibold mt-1">{{ $item->temperature }}°C</p>
                                        </div>
                                        <div class="bg-green-50/50 p-3 rounded-lg border border-green-100">
                                            <p class="text-xs font-medium text-green-700 uppercase tracking-wider">Pulse</p>
                                            <p class="text-sm font-semibold mt-1">{{ $item->pulse }} bpm</p>
                                        </div>
                                        <div class="bg-green-50/50 p-3 rounded-lg border border-green-100">
                                            <p class="text-xs font-medium text-green-700 uppercase tracking-wider">Respiration</p>
                                            <p class="text-sm font-semibold mt-1">{{ $item->respiration }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif ($record['type'] === 'prescription')
                    <!-- Prescription Card -->
                    <div class="relative group">
                        <div class="absolute -left-9 top-5 h-4 w-4 rounded-full bg-white border-4 border-purple-500 shadow-sm flex items-center justify-center">
                            <svg class="h-2 w-2 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 p-5 border border-gray-100">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Prescription</h3>
                                            <p class="text-xs text-gray-500 mt-1">Prescribed by Dr. {{ $item->doctor->name }} at {{ $item->created_at->format('g:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h4 class="text-xs font-medium text-gray-600 mb-2 uppercase tracking-wider">Medications</h4>
                                        <ul class="space-y-3">
                                            @foreach ($item->medications as $med)
                                                <li class="flex items-start">
                                                    <div class="flex-shrink-0 mt-0.5">
                                                        <div class="flex items-center justify-center h-4 w-4 rounded-full bg-purple-100 text-purple-600">
                                                            <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900">{{ $med->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $med->dosage }} ({{ $med->frequency }})</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif ($record['type'] === 'dispensation')
                    <!-- Dispensation Card -->
                    <div class="relative group">
                        <div class="absolute -left-9 top-5 h-4 w-4 rounded-full bg-white border-4 border-amber-500 shadow-sm flex items-center justify-center">
                            <svg class="h-2 w-2 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM10 17l-3.5-3.5 1.41-1.41L10 14.17 15.18 9l1.41 1.41L10 17z"/>
                            </svg>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 p-5 border border-gray-100">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="bg-amber-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Medication Dispensed</h3>
                                            <p class="text-xs text-gray-500 mt-1">By {{ $item->pharmacist->name ?? 'Pharmacist' }} at {{ $item->created_at->format('g:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="bg-amber-50/50 p-3 rounded-lg border border-amber-100">
                                            <p class="text-xs font-medium text-amber-700 uppercase tracking-wider">Prescription ID</p>
                                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $item->prescription_id }}</p>
                                        </div>
                                        <div class="bg-amber-50/50 p-3 rounded-lg border border-amber-100">
                                            <p class="text-xs font-medium text-amber-700 uppercase tracking-wider">Date Dispensed</p>
                                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $item->created_at->format('M j, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
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
    @endforeach

</div>