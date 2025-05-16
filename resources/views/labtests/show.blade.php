@extends('layouts.app')

@section('title', 'Lab Test Details')

@section('content')
<div class="max-w-4xl mx-auto p-4 sm:p-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-white">Lab Test Details</h2>
                    <p class="text-blue-100 text-sm mt-1">{{ $labtest->test_name }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white text-blue-800">
                    {{ ucfirst(str_replace('_', ' ', $labtest->status)) }}
                </span>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">PATIENT INFORMATION</h3>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $labtest->patient->name }}</p>
                            <p class="text-sm text-gray-500">ID: {{ $labtest->patient->id }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">REQUESTING PHYSICIAN</h3>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Dr. {{ $labtest->doctor->name }}</p>
                            <p class="text-sm text-gray-500">Requested: {{ $labtest->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($labtest->notes)
            <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                <h3 class="text-sm font-medium text-blue-800 mb-2">PHYSICIAN NOTES</h3>
                <p class="text-sm text-blue-900">{{ $labtest->notes }}</p>
            </div>
            @endif

            @if ($labtest->status === 'pending')
            <form action="{{ route('labtests.update', $labtest->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="result" class="block text-sm font-medium text-gray-700 mb-1">TEST RESULTS</label>
                    <textarea id="result" name="result" rows="6" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Enter test results..." required></textarea>
                    <p class="mt-1 text-sm text-gray-500">Please provide detailed test findings and interpretations</p>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Submit Results
                    </button>
                </div>
            </form>
            @else
            <div class="bg-green-50 p-5 rounded-lg border-l-4 border-green-400">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-sm font-medium text-green-800 mb-2">TEST RESULTS</h3>
                        <div class="prose prose-sm max-w-none text-green-900">
                            {!! nl2br(e($labtest->result)) !!}
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">
                        Completed: {{ $labtest->updated_at->format('M j, Y \a\t g:i A') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection