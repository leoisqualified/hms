@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prescribe Medication</h2>

    <form action="{{ route('doctor.prescribe.store', $appointment->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Medication Name</label>
            <input type="text" name="medication" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Instructions</label>
            <textarea name="instructions" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price ($)</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Issue Prescription</button>
    </form>
</div>
@endsection
