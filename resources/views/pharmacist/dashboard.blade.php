@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pharmacist Dashboard</h2>

    <h3>Prescriptions Awaiting Dispensation</h3>
    <table class="table">
        <tr>
            <th>Medication</th>
            <th>Patient</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
        @foreach ($prescriptions as $prescription)
        <tr>
            <td>{{ $prescription->medication }}</td>
            <td>{{ $prescription->appointment->patient->name }}</td>
            <td class="text-success">Paid</td>
            <td>
                <form action="{{ route('pharmacist.dispense', $prescription->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Dispense</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
