@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Prescriptions</h2>

    <table class="table">
        <tr>
            <th>Medication</th>
            <th>Instructions</th>
            <th>Price</th>
            <th>Payment</th>
        </tr>
        @foreach ($appointments as $appointment)
            @foreach ($appointment->prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->medication }}</td>
                <td>{{ $prescription->instructions }}</td>
                <td>${{ number_format($prescription->price, 2) }}</td>
                <td>
                    @if(!$prescription->paid)
                        <a href="{{ route('prescription.pay', $prescription->id) }}" class="btn btn-warning">Pay Now</a>
                    @else
                        <span class="text-success">Paid</span>
                    @endif
                </td>
            </tr>
            @endforeach
        @endforeach
    </table>
</div>
@endsection
