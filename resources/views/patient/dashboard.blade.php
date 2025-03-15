<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Patient Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Upcoming Appointments</h3>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2">Doctor</th>
                                <th class="p-2">Date</th>
                                <th class="p-2">Time</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr class="border-t">
                                    <td class="p-2">{{ $appointment->doctor->name }}</td>
                                    <td class="p-2">{{ $appointment->date }}</td>
                                    <td class="p-2">{{ $appointment->time }}</td>
                                    <td class="p-2">
                                        @if($appointment->is_paid)
                                            <span class="text-green-500 font-semibold">Paid</span>
                                        @else
                                            <span class="text-red-500 font-semibold">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="p-2">
                                        @if(!$appointment->is_paid)
                                            <form action="{{ route('patient.pay', $appointment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                                                    Pay Now
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">Payment Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
