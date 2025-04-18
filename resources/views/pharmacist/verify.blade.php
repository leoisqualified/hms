@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white rounded-xl shadow-md overflow-hidden p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Verify Patient</h2>
        <form action="{{ route('pharmacist.verify') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="patient_id" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                       placeholder="Enter Patient ID" required>
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Search Patient
            </button>
        </form>

        @if($errors->any())
            <div class="mt-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif
    </div>
@endsection