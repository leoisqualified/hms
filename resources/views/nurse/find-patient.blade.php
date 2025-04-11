@extends('layouts.app')

@section('title', 'Find Patient')

@section('content')
    <h2 class="text-xl font-bold mb-4">Find Patient</h2>

    <form action="{{ route('nurse.find-patient') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="patient_id" class="block font-medium">Patient ID:</label>
            <input type="text" name="patient_id" id="patient_id" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Search Patient
        </button>
    </form>

    @if ($errors->has('not_found'))
        <div class="mt-4 text-red-600">
            {{ $errors->first('not_found') }}
        </div>
    @endif
@endsection
