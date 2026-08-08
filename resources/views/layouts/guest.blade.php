<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    /* Chrome, Edge, Safari */
    body::-webkit-scrollbar {
        width: 10px;
    }
    body::-webkit-scrollbar-track {
        background: transparent;
        border-radius: 20px;
    }
    body::-webkit-scrollbar-thumb {
        background: #2E4F7D;
        border-radius: 20px;
    }

    body::-webkit-scrollbar-thumb:hover {
        background: #203450;
    }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                {{-- <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a> --}}
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 rounded-xl bg-white shadow-lg border-gray-100 overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
