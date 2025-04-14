@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">Search Patient by ID</h2>
                <a href="{{ url()->previous() }}" class="text-white hover:text-blue-200 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="p-6">
            @if ($errors->has('not_found'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                    <p>{{ $errors->first('not_found') }}</p>
                </div>
            @endif
            @if (session('success'))
                <div class="mb-4 text-green-600 bg-green-100 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif


            <form action="{{ route('nurse.find-patient') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-1">Patient ID</label>
                    <input type="text" name="patient_id" id="patient_id" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                           placeholder="Enter patient ID" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                        Search Patient
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection