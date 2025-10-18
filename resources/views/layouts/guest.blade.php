<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full flex flex-col items-center justify-center">
        <div class="flex items-center space-x-4 mb-6">
            <!-- School Logo -->
            <img src="{{ asset('storage/logo/logo.png') }}" alt="School Logo" class="w-16 h-16">

            <!-- Group/Organization Logo -->
            <img src="{{ asset('storage/logo/ProGuil.jpg') }}" alt="Group Logo" class="w-16 h-16">
        </div>
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
