<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Pharmacist Dashboard</h2>
    </x-slot>

    <div class="bg-white p-6 shadow-md rounded-lg">
        <h3 class="text-lg font-bold">Pending Prescriptions</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Patient</th>
                    <th class="p-2">Doctor</th>
                    <th class="p-2">Medications</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prescriptions as $prescription)
                    <tr class="border-t">
                        <td class="p-2">{{ $prescription->patient->name }}</td>
                        <td class="p-2">{{ $prescription->doctor->name }}</td>
                        <td class="p-2">{{ $prescription->medication }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
