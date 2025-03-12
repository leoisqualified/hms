<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Admin Dashboard</h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-lg font-bold">Total Doctors</h3>
            <p class="text-2xl">{{ $doctorCount }}</p>
        </div>
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-lg font-bold">Total Patients</h3>
            <p class="text-2xl">{{ $patientCount }}</p>
        </div>
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-lg font-bold">Appointments Today</h3>
            <p class="text-2xl">{{ $appointmentCount }}</p>
        </div>
    </div>
</x-app-layout>
