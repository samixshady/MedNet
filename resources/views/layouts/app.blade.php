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

        <!-- Mobile Navbar Styles -->
        <link rel="stylesheet" href="{{ asset('css/mobile-navbar.css') }}">

        <!-- Mobile Sidebar Styles -->
        <link rel="stylesheet" href="{{ asset('css/mobile-sidebar.css') }}">

        <!-- Sidebar Styles -->
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

        <!-- Navbar Styles -->
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

        <!-- Mobile Footer Styles -->
        <link rel="stylesheet" href="{{ asset('css/mobile-footer.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Mobile Navbar Toggle & Overlay -->
            <x-mobile-navbar />

            <!-- Mobile Sidebar (Collapsible) -->
            <x-mobile-sidebar />

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </main>

            <!-- Footer -->
            <x-footer />
            
            <!-- Mobile Footer -->
            <x-mobile-footer />
        </div>

        <!-- Mobile Sidebar Collapse Script -->
        <script src="{{ asset('js/mobile-sidebar.js') }}"></script>
    </body>
</html>
