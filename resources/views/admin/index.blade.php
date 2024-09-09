<x-admin-layout>
   <x-slot name="header">
        {{ __('Administrator') }}
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-kenchic-blue overflow-hidden rounded-md">
                <div class="p-6 text-kenchic-gold text-center">
                    Greetings {{ Auth::user()->name}}, you're at the administrator panel.
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>