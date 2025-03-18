@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Book Appointment</h2>
    <form action="{{ route('patient.book-appointment.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Choose Doctor</label>
            <select name="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Choose Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Choose Time</label>
            <input type="time" name="time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Book Now</button>
    </form>
</div>
@endsection
