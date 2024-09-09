<x-guest-layout>
    <div class="z-10 w-full items-center">
        <div class="space-y-5 text-center flex justify-center">
            <img class="w-1/3 h-1/3" src="{{ asset('/images/kenchic-logo.svg') }}" alt="">
        </div>
    </div>

    <div class="w-full z-10 backdrop-blur-lg md:w-full lg:w-1/3 mx-auto md:mx-0 sm:my-10 rounded-md shadow-xl">
        <div class="space-y-4 bg-transparent p-10 flex flex-col w-full rounded-md shadow-md shadow-blue-kenchic">
            <h2 class="text-xl font-bold text-left leading-tight">
                {{ __('Reset Password') }}
            </h2>

            <div class="text-sm font-bold">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            
            <form method="POST" class="space-y-4" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <x-label-auth for="email" :value="__('Email')" />
                <x-text-input-auth id="email" class="block w-full" type="email" name="email" :value="old('email')"
                    placeholder="john.doe@email.domain" required autofocus />
                <x-input-error :messages="$errors->get('email')" />

                <!-- Session Status -->
                <x-auth-session-status :status="session('status')" />

                <x-primary-button class="w-full">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>