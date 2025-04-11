@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Patients List</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.patients.index') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search by name or email"
               value="{{ request('search') }}"
               class="w-full md:w-1/3 px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
    </form>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($patients as $index => $patient)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('admin.patients.edit', $patient) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No patients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
