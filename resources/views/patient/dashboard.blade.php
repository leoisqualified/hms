@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Patient Dashboard</h2>
    <a href="{{ route('patient.book-appointment') }}" class="btn btn-primary">Book Appointment</a>
    <a href="{{ route('patient.prescriptions') }}" class="btn btn-info">View Prescriptions</a>

    <h3>Your Appointments</h3>
    <table class="table">
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Doctor</th>
            <th>Status</th>
            <th>Payment</th>
        </tr>
        @foreach ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>
            <td>{{ $appointment->doctor->name }}</td>
            <td>{{ ucfirst($appointment->status) }}</td>
            <td>
                @if(!$appointment->is_paid)
                    <a href="{{ route('patient.pay-appointment', $appointment->id) }}" class="btn btn-warning">Pay Now</a>
                @else
                    <span class="text-success">Paid</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
