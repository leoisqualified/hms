@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden p-8 text-center transform transition-all hover:scale-[1.02] duration-200">
        <div class="flex justify-center mb-6">
            <div class="bg-green-100 p-4 rounded-full animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-3">Payment Successful!</h1>
        <p class="text-lg text-gray-600 mb-6">Thank you for your payment 🎉</p>
        
        <div class="space-y-4">
            <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                <p class="text-green-700">Your transaction has been completed successfully.</p>
            </div>
            
            <div class="pt-4">
                <a href="{{ route('patient.medications') }}" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-xl font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all shadow-md hover:shadow-lg">
                    My Medications
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection