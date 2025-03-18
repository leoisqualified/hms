@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Record Vitals for {{ $appointment->patient->name }}</h2>

    <form action="{{ route('nurse.store', $appointment->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Temperature (°F)</label>
            <input type="number" name="temperature" class="form-control" step="0.1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Blood Pressure</label>
            <input type="text" name="blood_pressure" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pulse</label>
            <input type="number" name="pulse" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Weight (kg)</label>
            <input type="number" name="weight" class="form-control" step="0.1" required>
        </div>

        <button type="submit" class="btn btn-success">Save Vitals</button>
    </form>
</div>
@endsection
