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

<body>
    <x-navigations.navbar />
    {{-- @include('layouts.navigation') --}}


    <!-- Page Heading -->
    {{-- @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

    <!-- Page Content -->
    <main
        class="bg-background min-h-screen flex flex-col container mx-auto px-4 sm:px-6 lg:px-8 py-12 text-foreground mt-4 gap-6">
        {{ $slot }}
    </main>


    @yield('modal')

    @if (session('success'))
        <x-toast type="success" text="{{ session('success') }}" />
    @elseif(session('failed'))
        <x-toast type="failed" text="{{ session('failed') }}" />
    @endif

    <x-navigations.footer />
</body>

</html>
