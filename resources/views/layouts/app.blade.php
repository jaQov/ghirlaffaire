<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'GhirLaffaire') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <x-home.header />

    <main class="min-h-screen">
        @yield('content')

    </main>

    <x-home.footer />

    @livewireScripts
</body>

</html>