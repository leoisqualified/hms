@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Doctor Schedule</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.schedule.update', $schedule->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Day of the Week</label>
            <input type="text" name="day_of_week" value="{{ old('day_of_week', $schedule->day_of_week) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('day_of_week')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Start Time</label>
            <input type="time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('start_time')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">End Time</label>
            <input type="time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('end_time')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Schedule
            </button>
            <a href="{{ route('admin.schedule.manage') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
