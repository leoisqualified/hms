@extends('layouts.app')

@section('title', 'Record Vitals')

@section('content')
    <h2 class="text-xl font-bold mb-4">Record Vitals for {{ $patient->name }}</h2>

    <form action="{{ route('nurse.store-vitals', $patient->patient_id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="temperature" class="block font-medium">Temperature (°C):</label>
            <input type="number" name="temperature" id="temperature" step="0.1" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="blood_pressure" class="block font-medium">Blood Pressure:</label>
            <input type="text" name="blood_pressure" id="blood_pressure" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="pulse" class="block font-medium">Pulse (bpm):</label>
            <input type="number" name="pulse" id="pulse" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="weight" class="block font-medium">Weight (kg):</label>
            <input type="number" name="weight" id="weight" step="0.1" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Vitals
            </button>
        </div>
    </form>
@endsection
