<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Money Tracker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 500)"
        class="max-w-md mx-auto min-h-screen relative bg-background shadow-xl">
        <div x-show="loading">
            <x-layout.page-skeleton />
        </div>
        <div x-show="!loading" x-cloak>
            {{ $slot }}
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                window.Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#015C4B'
                });
            });
        </script>
    @endif
</body>

</html>
