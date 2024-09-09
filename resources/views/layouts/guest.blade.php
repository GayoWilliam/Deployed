<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:500&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans tracking-wide font-semibold text-kenchic-blue antialiased bg-kenchic-beige overflow-hidden overscroll-contain h-dvh w-dvw">
        <div style="background-image: url('{{ asset('images/chicken.jpg') }}'); image-rendering: -webkit-optimize-contrast;" class="fixed -z-10 bg-cover h-full w-full"></div>
        
        <div class="h-screen bg-transparent px-10 z-50 flex flex-col sm:justify-center pt-6 sm:pt-0 text-center md:text-left md:flex-row justify-evenly md:items-center">
            {{ $slot }}
        </div>
    </body>

</html>
