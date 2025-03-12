<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hospital Management System' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <x-navbar />  <!-- Common navbar for all roles -->

    <main class="container mx-auto py-6">
        {{ $slot }}  <!-- Each role’s dashboard content goes here -->
    </main>

    <x-footer />  <!-- Footer -->
</body>
</html>
