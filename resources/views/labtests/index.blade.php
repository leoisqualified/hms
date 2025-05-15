@extends('layouts.app')

@section('title', 'Lab Tests')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Pending Lab Tests</h2>

    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Patient</th>
                <th class="px-4 py-2">Test</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labtests as $test)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $test->patient->name }}</td>
                <td class="px-4 py-2">{{ $test->test_name }}</td>
                <td class="px-4 py-2">{{ ucfirst($test->status) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('labtests.show', $test->id) }}" class="text-indigo-600 hover:underline">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
