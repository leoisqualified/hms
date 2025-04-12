@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">
        Schedule for {{ $doctor->name }}
    </h1>

    {{-- Add Schedule Form --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <form action="{{ route('admin.schedule.store', $doctor->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Day of Week</label>
                    <select name="day_of_week" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Start Time</label>
                    <input type="time" name="start_time" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">End Time</label>
                    <input type="time" name="end_time" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Add Slot
            </button>
        </form>
    </div>

    {{-- Existing Schedules --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Existing Slots</h2>
        @forelse($schedules as $schedule)
            <div class="flex justify-between items-center border-b py-2">
                <span>{{ $schedule->day_of_week }}: {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</span>
                <form action="{{ route('admin.schedule.delete', $schedule->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline text-sm">Delete</button>
                </form>
            </div>
        @empty
            <p class="text-sm text-gray-500">No schedule defined yet.</p>
        @endforelse
    </div>
</div>
@endsection
