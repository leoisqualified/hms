<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Patient Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                <p class="text-gray-700">You can book appointments, view prescriptions, and manage payments.</p>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('appointments.index') }}" class="block p-4 bg-blue-500 text-white text-center rounded-lg hover:bg-blue-700">
                        Book an Appointment
                    </a>
                    <a href="{{ route('prescriptions.index') }}" class="block p-4 bg-green-500 text-white text-center rounded-lg hover:bg-green-700">
                        View Prescriptions
                    </a>
                    <a href="{{ route('billing.index') }}" class="block p-4 bg-yellow-500 text-white text-center rounded-lg hover:bg-yellow-700">
                        Manage Payments
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
