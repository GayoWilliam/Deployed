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
        <script src="https://cdn.jsdelivr.net/npm/powerbi-client@2.8.0/dist/powerbi.js"></script>
    </head>

    <body class="font-sans antialiased tracking-wide font-semibold leading-tight text-kenchic-blue bg-kenchic-beige overscroll-contain h-dvh">
        <div class="h-full flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-kenchic-blue text-kenchic-gold shadow">
                    <div class="max-w-7xl mx-auto py-2 px-4">
                        <h2 class="text-sm">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow overscroll-contain">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
