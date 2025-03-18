@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nurse Dashboard</h2>

    <h3>Today's Appointments</h3>
    <table class="table">
        <tr>
            <th>Patient</th>
            <th>Date</th>
            <th>Time</th>
            <th>Vitals Recorded</th>
            <th>Action</th>
        </tr>
        @foreach ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->patient->name }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>
            <td>
                @if($appointment->vitals)
                    <span class="text-success">Recorded</span>
                @else
                    <span class="text-warning">Not recorded</span>
                @endif
            </td>
            <td>
                @if(!$appointment->vitals)
                    <a href="{{ route('nurse.record', $appointment->id) }}" class="btn btn-primary">Record Vitals</a>
                @else
                    <span class="text-muted">Completed</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
 