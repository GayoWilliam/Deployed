<nav x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute ml-5 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button
                    class="text-kenchic-blue rounded-md md:hidden focus:outline-none focus:shadow-outline transition duration-150 ease-in-out hover:text-kenchic-red"
                    @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center">
                <a href="{{ route('dashboard') }}">
                    <img class="w-10 h-10" src="{{ asset('/images/kenchic-logo.svg') }}" alt="">
                </a>
                <div class="ml-4 space-x-3">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>

                    @can('view admin')
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')">
                            {{ __('Admin') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex sm:static sm:inset-auto sm:ml-6 sm:pr-0 space-x-5">
                @if (Route::has('login'))
                    <!-- Profile dropdown -->
                    <div class="relative">
                        @auth
                            <x-dropdown align="right" width="40">
                                <x-slot name="trigger">
                                    <button class="inline-flex px-3 py-2 border border-transparent text-xs leading-4 font-bold rounded-md text-kenchic-blue uppercase bg-transparent hover:text-kenchic-red focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <div class="space-x-2">
                                <a href="{{ route('login') }}"
                                    class="login_request text-xs text-gray-500 hover:text-blue-500 transition ease-in-out duration-300">Login</a>
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
