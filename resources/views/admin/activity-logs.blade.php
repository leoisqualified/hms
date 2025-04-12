@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Activity Logs</h1>

    <!-- Search -->
    <form method="GET" class="mb-6">
        <input
            type="text"
            name="search"
            placeholder="Search by user or action..."
            value="{{ request('search') }}"
            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-indigo-200"
        />
    </form>

    <!-- Logs -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg divide-y divide-gray-200">
        @forelse ($logs as $log)
            <div class="p-4 flex items-start gap-4 hover:bg-gray-50">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($log->user->name) }}&background=4f46e5&color=fff"
                     class="h-10 w-10 rounded-full" alt="{{ $log->user->name }}">
                <div class="flex-1">
                    <p class="text-sm font-medium text-indigo-600">{{ $log->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $log->description }}</p>
                </div>
                <div class="text-sm text-gray-500">
                    {{ $log->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-gray-500">No logs found.</div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
