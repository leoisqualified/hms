<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hospital Management System' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <x-navbar />  <!-- Common navbar -->

    <main class="container mx-auto py-6 flex-grow">
        {{ $slot }}  <!-- Main Content -->
    </main>

    <x-footer />  <!-- Fixed Footer -->
    
</body>
</html>
