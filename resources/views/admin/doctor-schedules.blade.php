@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Doctor Schedules</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <ul class="space-y-4">
            @foreach($doctors as $doctor)
                <li class="flex justify-between items-center border-b pb-4">
                    <div>
                        <p class="text-lg font-semibold text-gray-900">{{ $doctor->name }}</p>
                        <p class="text-sm text-gray-600">{{ $doctor->email }}</p>
                    </div>
                    <a href="{{ route('admin.schedule.manage', $doctor->id) }}" class="text-blue-600 hover:underline">Manage Schedule</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
