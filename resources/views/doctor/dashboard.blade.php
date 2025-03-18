@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Doctor Dashboard</h2>

    <h3>Appointments</h3>
    <table class="table">
        <tr>
            <th>Patient</th>
            <th>Date</th>
            <th>Time</th>
            <th>Vitals</th>
            <th>Actions</th>
        </tr>
        @foreach ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->patient->name }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>
            <td>
                @if($appointment->vitals)
                    Temp: {{ $appointment->vitals->temperature }}°F, 
                    BP: {{ $appointment->vitals->blood_pressure }},
                    Pulse: {{ $appointment->vitals->pulse }},
                    Weight: {{ $appointment->vitals->weight }} kg
                @else
                    <span class="text-warning">Not recorded</span>
                @endif
            </td>
            <td>
                <a href="{{ route('doctor.prescribe', $appointment->id) }}" class="btn btn-primary">Prescribe</a>
                <form action="{{ route('doctor.complete', $appointment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Complete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
