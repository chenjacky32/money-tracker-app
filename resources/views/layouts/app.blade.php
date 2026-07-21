<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Money Tracker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="max-w-md mx-auto min-h-screen relative bg-background py-20 shadow-xl overflow-x-hidden">
        <!-- Header UI Component -->
        <x-layout.header-nav />

        {{ $slot }}

        <!-- Floating Action Button -->
        <a href="/transactions/create"
            class="fixed bottom-24 right-[calc(50%-12rem+1.5rem)] md:right-[calc(50%-14rem+2rem)] w-14 h-14 bg-primary text-white rounded-2xl shadow-lg flex items-center justify-center hover:bg-primary/90 transition-transform active:scale-95 z-50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </a>

        <x-layout.bottom-nav />
    </div>
</body>

</html>
