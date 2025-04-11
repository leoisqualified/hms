@extends('layouts.app')

@section('title', 'Pharmacist Dashboard')

@section('content')
    <h2 class="text-xl font-bold mb-4">Pharmacist Dashboard</h2>

    <div class="mb-4">
        <a href="{{ route('pharmacist.verify-patient') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Verify Patient
        </a>
    </div>

    <div>
        <h3 class="text-lg font-medium">Pending Tasks</h3>
        <!-- You can display pending medication dispensing tasks here -->
    </div>
@endsection
