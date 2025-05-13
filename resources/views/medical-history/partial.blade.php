<div class="space-y-8">

    @foreach ($groupedByDate as $date => $records)
        <div class="sticky top-0 z-10 bg-white py-3 px-4 shadow-sm rounded-lg border border-gray-100 flex items-center">
            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">
                {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
            </h2>
        </div>

        <div class="space-y-4 pl-8 border-l-2 border-gray-200 ml-4">
            @foreach ($records as $record)
                @php
                    $item = $record['data'];
                @endphp

                @if ($record['type'] === 'appointment')
                    <div class="relative group">
                        <div class="absolute -left-8 top-5 h-3 w-3 rounded-full bg-blue-500 border-2 border-white shadow"></div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-5 border-l-4 border-blue-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <h3 class="font-semibold text-gray-800">Appointment with Dr. {{ $item->doctor->name }}</h3>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('g:i A') }}</p>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Completed
                                </span>
                            </div>
                            @if($item->notes)
                                <div class="mt-3 bg-blue-50 p-3 rounded-md">
                                    <p class="text-sm text-blue-800">{{ $item->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                @elseif ($record['type'] === 'vital')
                    <div class="relative group">
                        <div class="absolute -left-8 top-5 h-3 w-3 rounded-full bg-green-500 border-2 border-white shadow"></div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-5 border-l-4 border-green-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <h3 class="font-semibold text-gray-800">Vitals Check</h3>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Recorded by {{ $item->nurse->name ?? 'Nurse' }} at {{ $item->created_at->format('g:i A') }}</p>
                                </div>
                            </div>
                            <div class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="bg-green-50 p-2 rounded-md">
                                    <p class="text-xs font-medium text-green-700">BLOOD PRESSURE</p>
                                    <p class="text-sm font-semibold">{{ $item->blood_pressure }}</p>
                                </div>
                                <div class="bg-green-50 p-2 rounded-md">
                                    <p class="text-xs font-medium text-green-700">TEMPERATURE</p>
                                    <p class="text-sm font-semibold">{{ $item->temperature }}°C</p>
                                </div>
                                <div class="bg-green-50 p-2 rounded-md">
                                    <p class="text-xs font-medium text-green-700">PULSE</p>
                                    <p class="text-sm font-semibold">{{ $item->pulse }} bpm</p>
                                </div>
                                <div class="bg-green-50 p-2 rounded-md">
                                    <p class="text-xs font-medium text-green-700">RESPIRATION</p>
                                    <p class="text-sm font-semibold">{{ $item->respiration }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif ($record['type'] === 'prescription')
                    <div class="relative group">
                        <div class="absolute -left-8 top-5 h-3 w-3 rounded-full bg-purple-500 border-2 border-white shadow"></div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-5 border-l-4 border-purple-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="font-semibold text-gray-800">Prescription</h3>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Prescribed by Dr. {{ $item->doctor->name }} at {{ $item->created_at->format('g:i A') }}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h4 class="text-xs font-medium text-gray-600 mb-2">MEDICATIONS:</h4>
                                <ul class="space-y-2">
                                    @foreach ($item->medications as $med)
                                        <li class="flex items-start">
                                            <svg class="flex-shrink-0 h-4 w-4 text-purple-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="ml-2 text-sm text-gray-700">
                                                <span class="font-medium">{{ $med->name }}</span> — {{ $med->dosage }} ({{ $med->frequency }})
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                @elseif ($record['type'] === 'dispensation')
                    <div class="relative group">
                        <div class="absolute -left-8 top-5 h-3 w-3 rounded-full bg-yellow-500 border-2 border-white shadow"></div>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-5 border-l-4 border-yellow-500">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        <h3 class="font-semibold text-gray-800">Medication Dispensed</h3>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">By {{ $item->pharmacist->name ?? 'Pharmacist' }} at {{ $item->created_at->format('g:i A') }}</p>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Fulfilled
                                </span>
                            </div>
                            <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <p class="text-xs font-medium text-gray-600">PRESCRIPTION ID</p>
                                    <p class="text-sm">{{ $item->prescription_id }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-600">DATE DISPENSED</p>
                                    <p class="text-sm">{{ $item->created_at->format('M j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach

</div>