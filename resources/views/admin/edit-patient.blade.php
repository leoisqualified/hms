@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Patient</h1>

    <form method="POST" action="{{ route('admin.patients.update', $patient->id) }}" class="bg-white shadow rounded-lg p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.patients') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
