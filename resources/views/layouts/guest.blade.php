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
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">
        <!-- Vanta.js Background -->
        <div id="vanta-bg" class="fixed inset-0 -z-10"></div>

        <!-- Mobile Test Credentials Box -->
        <div class="md:hidden fixed top-4 left-1/2 -translate-x-1/2 z-40 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-lg shadow-lg border border-gray-300 dark:border-gray-700 px-3 py-2 max-w-[90vw]">
            <div class="text-[10px] leading-tight space-y-1">
                <p class="font-bold text-center text-gray-900 dark:text-white mb-1">🔑 Test</p>
                <div class="flex gap-3 justify-center">
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">User:</p>
                        <p class="font-mono text-gray-800 dark:text-gray-200">duck@duck.com</p>
                        <p class="font-mono text-gray-800 dark:text-gray-200">duckduck</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Admin:</p>
                        <p class="font-mono text-gray-800 dark:text-gray-200">admin@admin.com</p>
                        <p class="font-mono text-gray-800 dark:text-gray-200">adminadmin</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Credentials Box -->
        <div class="fixed bottom-4 left-4 right-4 md:top-6 md:left-6 md:right-auto md:bottom-auto z-40 w-auto md:w-64 bg-white dark:bg-gray-900 rounded-lg shadow-xl border-2 border-gray-300 dark:border-gray-700 p-3 md:p-4">
            <div class="text-xs space-y-3">
                <h3 class="font-bold text-gray-900 dark:text-white text-center mb-3">🔑 Test Accounts</h3>
                
                <div class="space-y-1 pb-2 border-b border-gray-200 dark:border-gray-700">
                    <p class="font-semibold text-gray-900 dark:text-white">User Account:</p>
                    <p class="font-mono text-gray-800 dark:text-gray-200">duck@duck.com</p>
                    <p class="font-mono text-gray-800 dark:text-gray-200">duckduck</p>
                </div>

                <div class="space-y-1">
                    <p class="font-semibold text-gray-900 dark:text-white">Admin Account:</p>
                    <p class="font-mono text-gray-800 dark:text-gray-200">admin@admin.com</p>
                    <p class="font-mono text-gray-800 dark:text-gray-200">adminadmin</p>
                </div>
            </div>
        </div>
        
        <div class="min-h-screen flex flex-col justify-center items-center py-4 px-4">
            <div class="relative z-10">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-800" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-4 py-4 sm:px-6 sm:py-6 bg-white dark:bg-gray-500 shadow-md overflow-hidden rounded-lg relative z-10">
                {{ $slot }}
            </div>
        </div>

        <!-- Vanta.js Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.cells.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                VANTA.CELLS({
                    el: "#vanta-bg",
                    mouseControls: true,
                    touchControls: true,
                    gyroControls: false,
                    minHeight: 200.00,
                    minWidth: 200.00,
                    scale: 1.00,
                    color1: 0x95209,
                    color2: 0xb8b570,
                    size: 1.90,
                    speed: 0.50
                });
            });
        </script>
        
        <!-- Support Floating Button -->
        @include('components.support-floating-button')
    </body>
</html>
