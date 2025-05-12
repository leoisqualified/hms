<div class="space-y-8">

    <!-- Appointments -->
    <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-3">Appointments</h2>
        @forelse($appointments as $appt)
            <div class="bg-white shadow rounded-lg p-4 border mb-3">
                <div class="flex justify-between text-sm">
                    <span><strong>Doctor:</strong> {{ $appt->doctor->name }}</span>
                    <span class="text-gray-500">{{ $appt->created_at->format('M d, Y H:i') }}</span>
                </div>
                <p class="text-gray-600 mt-1">{{ $appt->notes ?? 'No notes provided.' }}</p>
            </div>
        @empty
            <p class="text-gray-500">No appointments found.</p>
        @endforelse
    </div>

    <!-- Vitals -->
    <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-3">Vitals</h2>
        @forelse($vitals as $vital)
            <div class="bg-white shadow rounded-lg p-4 border mb-3">
                <div class="flex justify-between text-sm">
                    <span><strong>Recorded by:</strong> {{ $vital->nurse->name ?? 'N/A' }}</span>
                    <span class="text-gray-500">{{ $vital->created_at->format('M d, Y H:i') }}</span>
                </div>
                <ul class="mt-2 text-gray-600 text-sm space-y-1">
                    <li>BP: {{ $vital->blood_pressure }}</li>
                    <li>Temp: {{ $vital->temperature }} °C</li>
                    <li>Pulse: {{ $vital->pulse }} bpm</li>
                    <li>Respiration: {{ $vital->respiration }}</li>
                </ul>
            </div>
        @empty
            <p class="text-gray-500">No vitals recorded.</p>
        @endforelse
    </div>

    <!-- Prescriptions -->
    <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-3">Prescriptions</h2>
        @forelse($prescriptions as $prescription)
            <div class="bg-white shadow rounded-lg p-4 border mb-3">
                <div class="flex justify-between text-sm">
                    <span><strong>Doctor:</strong> {{ $prescription->doctor->name }}</span>
                    <span class="text-gray-500">{{ $prescription->created_at->format('M d, Y H:i') }}</span>
                </div>
                <ul class="mt-2 text-gray-600 text-sm space-y-1">
                    @foreach($prescription->medications as $med)
                        <li>{{ $med->name }} - {{ $med->dosage }} ({{ $med->frequency }})</li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p class="text-gray-500">No prescriptions found.</p>
        @endforelse
    </div>

    <!-- Dispensations -->
    <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-3">Dispensations</h2>
        @forelse($dispensations as $disp)
            <div class="bg-white shadow rounded-lg p-4 border mb-3">
                <div class="flex justify-between text-sm">
                    <span><strong>Pharmacist:</strong> {{ $disp->pharmacist->name ?? 'N/A' }}</span>
                    <span class="text-gray-500">{{ $disp->created_at->format('M d, Y H:i') }}</span>
                </div>
                <p class="text-gray-600 text-sm mt-1">Prescription ID: {{ $disp->prescription_id }}</p>
            </div>
        @empty
            <p class="text-gray-500">No dispensations found.</p>
        @endforelse
    </div>

</div>
