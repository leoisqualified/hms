<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hospital Management' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <x-navbar />  <!-- Including the Navbar Component -->

        <main class="flex-grow container mx-auto p-4">
            {{ $slot }}  <!-- This is where each page's content will be inserted -->
        </main>

        <x-footer />  <!-- Including the Footer Component -->
    </div>
</body>
</html>
