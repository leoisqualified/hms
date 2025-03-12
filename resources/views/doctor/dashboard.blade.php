<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Doctor Dashboard</h2>
    </x-slot>

    <div class="bg-white p-6 shadow-md rounded-lg">
        <h3 class="text-lg font-bold">Today's Appointments</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Patient</th>
                    <th class="p-2">Time</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="border-t">
                        <td class="p-2">{{ $appointment->patient->name }}</td>
                        <td class="p-2">{{ $appointment->time }}</td>
                        <td class="p-2">
                            <a href="{{ route('doctor.prescribe', $appointment->id) }}" class="text-blue-500">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
