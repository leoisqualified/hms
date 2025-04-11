@extends('layouts.app')

@section('title', 'My Appointments')

@section('content')
    <h2 class="text-xl font-semibold mb-4">My Appointments</h2>

    @if ($appointments->isEmpty())
        <p class="text-gray-600">You have no appointments yet.</p>
    @else
        <table class="min-w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3">Date</th>
                    <th class="text-left p-3">Doctor</th>
                    <th class="text-left p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="border-b">
                        <td class="p-3">{{ $appointment->date->format('M d, Y') }}</td>
                        <td class="p-3">{{ $appointment->doctor->name }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-white {{ $appointment->status == 'checked_in' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
