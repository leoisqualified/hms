@extends('layouts.app')

@section('title', 'Patient Dashboard')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Welcome, {{ Auth::user()->name }}</h2>
    <p>Your Patient ID: <strong>{{ Auth::user()->patient->patient_id }}</strong></p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
        <a href="{{ route('patient.appointments') }}" class="bg-blue-500 text-white p-4 rounded">View Appointments</a>
        <a href="{{ route('patient.medications') }}" class="bg-green-500 text-white p-4 rounded">View Medications</a>
    </div>
@endsection
