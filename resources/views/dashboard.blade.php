<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <style>
            .mednet-text {
                font-size: 48px !important;
                font-style: italic;
                font-weight: 900;
                margin: 0;
            }
        </style>
        
        <div class="header-container">
            <div class="header-left">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mednet-text">
                    {{ __('MedNet') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>