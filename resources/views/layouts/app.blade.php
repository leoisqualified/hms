<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Management System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-900">
                <a href="{{ match(Auth::user()->role) {
                    'labtechnician' => route('labtests.index'),
                    default => route(Auth::user()->role . '.dashboard'),
                } }}">
                    Hospital Management System
                </a>                
            </h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600 hidden sm:inline">Welcome, {{ Auth::user()->name }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button onclick="document.getElementById('logout-form').submit()" 
                        class="text-sm text-red-600 hover:text-red-500 hover:underline">
                    Logout
                </button>
            </div>
        </div>
    </nav>
    

    <main>
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>