<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (Session::has('message'))
        <div class="alert alert-danger">
            <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 10000)"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">

                <button type="button" @click="open = false"
                    class="fixed top-10 right-10 z-10 rounded-md bg-red-strathmore px-5 py-4 text-black-strathmore transition">
                    <div class="flex items-center space-x-2">
                        <div>
                            <svg class="w-6 h-6 fill-current text-black-strathmore" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M12 5.99L19.53 19H4.47L12 5.99M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z" />
                            </svg>
                        </div>
                        <p class="font-bold">{{ Session::get('message') }}</p>
                    </div>
                </button>
            </div>
        </div>
    @endif

    <div class="z-10 w-full items-center">
        <div class="space-y-5 text-center flex justify-center">
            <img class="w-1/3 h-1/3" src="{{ asset('/images/kenchic-logo.svg') }}" alt="">
        </div>
    </div>

    <div class="w-full z-10 backdrop-blur-lg md:w-full lg:w-1/3 mx-auto md:mx-0 sm:my-10 rounded-md shadow-xl">
        <div class="space-y-4 bg-transparent p-10 flex flex-col w-full rounded-md shadow-md shadow-kenchic-blue">
            <h2 class="text-xl font-bold text-left leading-tight">
                Welcome Back
            </h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-label-auth for="email" :value="__('Email')" />
                    <x-text-input-auth id="email" type="email" name="email" :value="old('email')" required autofocus
                        placeholder="john.doe@email.domain" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <x-label-auth for="password" :value="__('Password')" />
                    <x-text-input-auth id="password" type="password" name="password" required
                        autocomplete="current-password" placeholder="Password must be at least 8 characters" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-transparent text-kenchic-blue" name="remember">
                            <span
                                class="ml-2 text-xs transition ease-in-out duration-150 hover:text-kenchic-blue hover:text-opacity-80 font-bold leading-tight">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-xs font-bold hover:text-kenchic-blue hover:text-opacity-80 transition ease-in-out duration-150"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <x-primary-button class="w-full py-2">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
