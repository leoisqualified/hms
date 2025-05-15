@extends('layouts.app')

@section('title', 'Lab Test Details')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-semibold mb-4">Lab Test: {{ $labtest->test_name }}</h2>

    <p><strong>Patient:</strong> {{ $labtest->patient->name }}</p>
    <p><strong>Requested by:</strong> Dr. {{ $labtest->doctor->name }}</p>
    <p><strong>Notes:</strong> {{ $labtest->notes }}</p>
    <p><strong>Status:</strong> {{ ucfirst($labtest->status) }}</p>

    @if ($labtest->status === 'pending')
    <form action="{{ route('labtests.update', $labtest->id) }}" method="POST" class="mt-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Result</label>
            <textarea name="result" rows="5" class="w-full border px-3 py-2 rounded" required></textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Submit Result</button>
    </form>
    @else
    <div class="mt-4 p-4 bg-green-50 rounded border border-green-200">
        <strong>Result:</strong> <br>{{ $labtest->result }}
    </div>
    @endif
</div>
@endsection
