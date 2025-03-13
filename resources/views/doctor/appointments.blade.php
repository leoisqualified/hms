<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2">Patient Name</th>
                                <th class="p-2">Date</th>
                                <th class="p-2">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr class="border-t">
                                    <td class="p-2">{{ $appointment->patient->name }}</td>
                                    <td class="p-2">{{ $appointment->date }}</td>
                                    <td class="p-2">{{ $appointment->time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
