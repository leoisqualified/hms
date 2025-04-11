@extends('layouts.app')

@section('title', 'My Medications')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Prescribed Medications</h2>

    @if ($medications->isEmpty())
        <p class="text-gray-600">You have no medications at this time.</p>
    @else
        <table class="min-w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3">Medication</th>
                    <th class="text-left p-3">Dosage</th>
                    <th class="text-left p-3">Prescribed On</th>
                    <th class="text-left p-3">Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medications as $med)
                    <tr class="border-b">
                        <td class="p-3">{{ $med->name }}</td>
                        <td class="p-3">{{ $med->dosage }}</td>
                        <td class="p-3">{{ $med->created_at->format('M d, Y') }}</td>
                        <td class="p-3">
                            @if ($med->is_paid)
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Paid</span>
                            @else
                                <form action="{{ route('payment.checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $med->price }}">
                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Pay Now</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
