@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md overflow-hidden p-8 text-center">
        <div class="flex justify-center mb-6">
            <div class="bg-red-100 p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-3">Payment Cancelled</h1>
        <p class="text-gray-600 mb-6">Your payment was not completed.</p>
        <div class="border-t pt-6">
            <a href="{{ route('patient.medications') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                My Medications
            </a>
        </div>
    </div>
</div>
@endsection