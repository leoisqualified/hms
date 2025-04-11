@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Patient History - {{ $patient->name }}</h2>

    <p><strong>Patient ID:</strong> {{ $patient->patient_id }}</p>
    <p><strong>Email:</strong> {{ $patient->email }}</p>

    <h4>Appointments</h4>
    @if($appointments->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No appointments found.</p>
    @endif
</div>
@endsection
