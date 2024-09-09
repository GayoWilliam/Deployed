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

<body class="font-sans antialiased tracking-wide">
    <div class="min-h-screen bg-kenchic-beige font-semibold leading-tight text-kenchic-blue">
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
        <main class="flex">
            <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-60" x-data="{ open: false }">
                <nav :class="{ 'block': open, 'hidden': !open }"
                    class="flex-grow p-4 space-y-3 bg-kenchic-blue mt-5 rounded-md ml-5 md:block overflow-y-auto">
                    @can('view roles and permissions')
                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                            <x-admin-link @click="open = !open">Authorization
                                <svg fill="currentColor" viewBox="0 0 20 20"
                                    :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                    class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-150 transform md:-mt-1 right-0">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </x-admin-link>

                            <div x-show="open" x-transition:enter="transition ease-in duration-150"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-out duration-150"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="relative right-0 w-full mt-2 origin-top-right rounded-md shadow-inner shadow-kenchic-gold">
                                <div class="px-2 py-3">
                                    <x-admin-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">Roles</x-admin-link>
                                    <x-admin-link :href="route('admin.permissions.index')" :active="request()->routeIs('admin.permissions.index')">Permissions</x-admin-link>
                                    @can('view associations')
                                        <x-admin-link :href="route('admin.associations.index')" :active="request()->routeIs('admin.associations.index')">Account Associations</x-admin-link>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endcan
                    @can('view users')
                        <x-admin-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">Users</x-admin-link>
                    @endcan
                </nav>
            </div>
            <div class="flex-1">
                @if (Session::has('message'))
                    <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 10000)"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="flex bg-green-700 mt-5 ml-8 mr-8 rounded justify-between font-semibold text-white items-center">
                        <div class="flex space-x-4 items-center p-4">
                            <svg class="w-4 h-4 flex-none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path
                                    d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z" />
                            </svg>
                            <span>{{ Session::get('message') }}</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" @click="open = false"
                            class="h-5 w-5 mr-4 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif

                @if (Session::has('error'))
                    <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 10000)"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="flex bg-red-800 mt-5 ml-8 mr-8 rounded justify-between font-semibold text-white items-center">
                        <div class="flex space-x-4 items-center p-4">
                            <svg class="w-4 h-4 flex-none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path
                                    d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z" />
                            </svg>
                            <span>{{ Session::get('error') }}</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" @click="open = false"
                            class="h-5 w-5 mr-4 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
