@extends('layouts.app')

@section('title', 'Request Lab Test')

@section('content')
<div class="max-w-2xl mx-auto p-4 sm:p-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Request Lab Test</h2>
            <p class="text-blue-100 text-sm mt-1">Patient: {{ $patient->name }}</p>
        </div>

        <form action="{{ route('labtests.store', $patient->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">
                    Test Name <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <input type="text" name="test_type" required 
                           class="pl-10 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="e.g. Complete Blood Count (CBC)">
                </div>
                <p class="mt-1 text-sm text-gray-500">Enter the name of the lab test to be performed</p>
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">
                    Test Category
                </label>
                <select name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Select a category</option>
                    <option value="hematology">Hematology</option>
                    <option value="biochemistry">Biochemistry</option>
                    <option value="microbiology">Microbiology</option>
                    <option value="immunology">Immunology</option>
                    <option value="urinalysis">Urinalysis</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="lab_technician_id" class="block text-sm font-medium text-gray-700">Assign Lab Technician</label>
                <select name="lab_technician_id" id="lab_technician_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Select Technician --</option>
                    @foreach($labTechnicians as $technician)
                        <option value="{{ $technician->id }}">{{ $technician->name }} ({{ $technician->email }})</option>
                    @endforeach
                </select>
            </div>
            

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">
                    Priority
                </label>
                <div class="mt-1 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="priority" value="routine" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <span class="ml-2 text-gray-700">Routine</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="priority" value="urgent" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <span class="ml-2 text-gray-700">Urgent</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="priority" value="stat" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <span class="ml-2 text-gray-700">STAT</span>
                    </label>
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">
                    Notes
                </label>
                <textarea name="notes" rows="4" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                <p class="mt-1 text-sm text-gray-500">Any special instructions for the lab</p>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Submit Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection