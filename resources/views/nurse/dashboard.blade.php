@extends('layouts.app')

@section('title', 'Nurse Dashboard')

@section('content')
    <h2 class="text-xl font-bold mb-4">Nurse Dashboard</h2>

    <div class="mb-4">
        <a href="{{ route('nurse.find-patient') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Find Patient
        </a>
    </div>

    <div>
        <h3 class="text-lg font-medium">Upcoming Tasks</h3>
        <!-- You can display upcoming tasks or reminders for the nurse here -->
    </div>
@endsection
