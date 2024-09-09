<x-guest-layout>
    <div class="z-10 w-full items-center">
        <div class="space-y-5 text-center flex justify-center">
            <img class="w-1/3 h-1/3" src="{{ asset('/images/kenchic-logo.svg') }}" alt="">
        </div>
    </div>

    <div class="w-full z-10 backdrop-blur-lg md:w-full lg:w-1/3 mx-auto md:mx-0 sm:my-10 rounded-md shadow-xl">
        <div class="space-y-4 bg-transparent p-10 flex flex-col w-full rounded-md shadow-md shadow-blue-kenchic">
            <div class="text-sm font-bold">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-primary-button>
                            {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-primary-button type="submit"
                        class="underline bg-transparent text-blue-kenchic">
                        {{ __('Log Out') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
