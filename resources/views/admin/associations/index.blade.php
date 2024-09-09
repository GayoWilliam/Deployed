<x-admin-layout>
    <x-slot name="header">
        {{ __('Associations') }}
    </x-slot>

    <div class="w-full">
        <div class="w-full mx-auto sm:px-6 lg:px-8 rounded-md px-8 py-3 overflow-y-auto">
            <div class="flex justify-between items-center mb-5">
                <div class="relative rounded-md border-transparent">
                    <form class="relative" action="{{ route('admin.associations.index') }}" method="GET">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-kenchic-blue" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <x-text-input-auth type="text" id="table-search-associations" class="block p-2 pl-10"
                            placeholder="Search for Association" name="search" value="{{ request('search') }}"
                            autofocus />
                    </form>
                </div>

                @can('add association')
                    <x-primary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-association')">
                        {{ __('Add PowerBi Account') }}
                    </x-primary-button>
                @endcan

                <x-modal name="create-association" :show="$errors->associationDeletion->isNotEmpty()" focusable>
                    <form method="POST" action="{{ route('admin.associations.store') }}" class="p-6">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 md:mb-0">
                                <x-label-auth for="email" :value="__('Email')" />
                                <x-text-input-auth name="email" type="text"
                                    class="@error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="john.doe@email.domain" required autofocus />
                            </div>

                            <div class="w-full md:w-1/2 px-3 md:mb-0">
                                <x-label-auth for="type" :value="__('Account Type')" />
                                <x-text-input-auth name="type" type="text"
                                    class="@error('type') is-invalid @enderror" placeholder="Specify the type of PowerBi licence"
                                    value="{{ old('type') }}" required autofocus />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 md:mb-0">
                                <x-label-auth for="password" :value="__('Password')" />
                                <x-text-input-auth id="password" name="password" type="password"
                                    placeholder="Password to the PowerBi account" required
                                    autocomplete="new-password" />
                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <x-label-auth for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input-auth id="password_confirmation" name="password_confirmation"
                                    type="password" placeholder="Passwords must match" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end w-full">
                            <x-primary-button type="submit" class="w-full">
                                Create
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>
            </div>

            <!-- Associations table -->
            <div class="w-full overflow-hidden rounded-md shadow-lg shadow-kenchic-blue">
                <div class="scrollbar-hide w-full overflow-y-auto max-h-screen">
                    <table class="w-full whitespace-no-wrap max-h-screen">
                        <thead>
                            <tr
                                class="sticky top-0 z-10 text-[10px] text-left text-kenchic-gold uppercase border-b-2 border-kenchic-gold bg-kenchic-blue">
                                <th class="px-4 py-4">PowerBi Account</th>
                                <th class="px-4">Account Type</th>
                                <th class="px-4">Associated Accounts</th>
                                <th class="px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-transparent divide-kenchic-blue divide-opacity-10 divide-y">
                            @foreach ($azure_accounts as $account)
                                <tr class="hover:bg-kenchic-blue transition ease-in-out duration-150 leading-tight group">
                                    <td class="py-5 px-4">
                                        <x-label-auth class="group-hover:text-kenchic-gold"
                                            value="{{ $account->azure_account }}" />
                                    </td>

                                    <td class="py-5 px-4">
                                        <x-label-auth class="group-hover:text-kenchic-gold"
                                            value="{{ $account->account_type }}" />
                                    </td>

                                    <td class="py-5 px-4">
                                        <x-label-auth class="group-hover:text-kenchic-gold"
                                            value="{{ $account->users->count() }}" />
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4">
                                            <!-- Delete PowerBi Account -->
                                            <form method="POST"
                                                action="{{ route('admin.associations.destroy', $account->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete powerBi account {{ $account->azure_account }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="flex items-center justify-between text-kenchic-red transform hover:scale-125"
                                                    aria-label="Delete" type="submit">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>