<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Patient Dashboard</h2>
    </x-slot>

    <div class="bg-white p-6 shadow-md rounded-lg">
        <h3 class="text-lg font-bold">Upcoming Appointments</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Doctor</th>
                    <th class="p-2">Date</th>
                    <th class="p-2">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="border-t">
                        <td class="p-2">{{ $appointment->doctor->name }}</td>
                        <td class="p-2">{{ $appointment->date }}</td>
                        <td class="p-2">{{ $appointment->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
