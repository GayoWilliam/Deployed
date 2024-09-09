<x-admin-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="w-full">
        <div class="w-full mx-auto sm:px-6 lg:px-8 rounded-md px-8 py-3 overflow-y-auto">
            <div class="flex justify-between items-center mb-5">
                <div class="relative rounded-md border-transparent">
                    <form class="relative" action="{{ route('admin.users.index') }}" method="GET">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-kenchic-blue" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <x-text-input-auth type="text" id="table-search-users" class="block p-2 pl-10"
                            placeholder="Search for User" name="search" value="{{ request('search') }}" autofocus />
                    </form>
                </div>

                @can('add user')
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-user')">
                        {{ __('Add User') }}
                    </x-primary-button>
                @endcan

                <x-modal name="create-user" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="POST" action="{{ route('admin.users.store') }}" class="p-6">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3 md:mb-0">
                                <x-label-auth for="name" :value="__('Name')" />
                                <x-text-input-auth name="name" type="text"
                                    class="@error('name') is-invalid @enderror" placeholder="John Doe"
                                    value="{{ old('name') }}" required autofocus />
                            </div>

                            <div class="w-full md:w-1/3 px-3 md:mb-0">
                                <x-label-auth for="email" :value="__('Email')" />
                                <x-text-input-auth name="email" type="text"
                                    class="@error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="john.doe@email.domain" required autofocus />
                            </div>

                            <div class="w-full md:w-1/3 px-3 md:mb-0">
                                <x-label-auth for="role" :value="__('Role')" />
                                <div class="relative">
                                    <select
                                        class="mt-2 text-xs block w-full 
                                        bg-transparent
                                        rounded-md border-none focus:border-none 
                                        hover:border-transparent
                                        shadow-sm shadow-kenchic-blue hover:shadow-lg hover:shadow-kenchic-blue  
                                        focus:shadow-md focus:shadow-kenchic-blue  
                                        ring-0 focus:ring-0 transition-all ease-in-out duration-150"
                                        id="role" name="role">
                                        <option disabled selected>Select user role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 md:mb-0">
                                <x-label-auth for="password" :value="__('Password')" />
                                <x-text-input-auth id="password" name="password" type="password"
                                    placeholder="Password must be at least 8 characters" required
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

            <!-- Users table -->
            <div class="w-full overflow-y-auto rounded-md shadow-lg shadow-kenchic-blue">
                <div class="scrollbar-hide w-full overflow-y-auto max-h-screen">
                    <table class="w-full whitespace-no-wrap max-h-screen">
                        <thead>
                            <tr
                                class="sticky top-0 z-10 text-[10px] text-left text-kenchic-gold uppercase bg-kenchic-blue border-b-2 border-kenchic-gold">
                                <th class="px-4 py-4">User</th>
                                <th class="px-4">Associated Powerbi Account</th>
                                <th class="px-4">Role</th>
                                @can('delete user')
                                    <th class="px-4">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="bg-transparent divide-kenchic-blue divide-opacity-10 divide-y">
                            @foreach ($users as $user)
                                <tr
                                    class="hover:bg-kenchic-blue group hover:text-kenchic-gold transition ease-in-out duration-150 leading-tight">
                                    <td class="px-4 py-2">
                                        <div class="flex items-center text-xs">
                                            <div>
                                                <p>{{ $user->name }}</p>
                                                <p class="text-[11px]">
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        @can('edit user association')
                                            <form method="POST" action="{{ route('admin.associations', $user->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="azure_account_id" onchange="this.form.submit()"
                                                    class="mt-1 block w-4/5 min:w-4/5 border-0 bg-transparent text-xs
                                                            shadow-sm shadow-kenchic-blue group-hover:shadow-kenchic-gold hover:shadow-md focus:shadow-md focus:shadow-kenchic-blue focus:border-none focus:ring-0
                                                            rounded-md transition ease-in-out duration-150">
                                                    <option value="" {{ $user->azureAccount ? '' : 'selected' }}>None
                                                    </option>
                                                    @foreach ($azureAccounts as $account)
                                                        <option value="{{ $account->id }}"
                                                            {{ $user->azureAccount && $user->azureAccount->id == $account->id ? 'selected' : '' }}>
                                                            {{ $account->azure_account }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @else
                                            <span>{{ $user->azureAccount ? $user->azureAccount->azure_account : 'None' }}</span>
                                        @endcan
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        @if (Auth::user()->can('edit user role'))
                                            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                                @csrf
                                                @method('PUT')

                                                <select onchange="this.form.submit()"
                                                    class="mt-1 block w-4/5 min:w-4/5 border-0 bg-transparent text-xs
                                                            shadow-sm shadow-kenchic-blue group-hover:shadow-kenchic-gold hover:shadow-md focus:shadow-md focus:shadow-kenchic-blue focus:border-none focus:ring-0
                                                            rounded-md transition ease-in-out duration-150"
                                                    id="role" name="role">
                                                    <option disabled selected>{{ $user->role }}</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ $user->role === $role->name ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @else
                                            <x-label-auth for="role_description" value="{{ $user->role }}" />
                                        @endif
                                    </td>

                                    @can('delete user')
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-xs">
                                                <form method="POST"
                                                    action="{{ route('admin.users.destroy', $user->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button x-on:click.prevent="$dispatch('open-modal', 'create-user')"
                                                        class="flex items-center justify-between text-kenchic-red rounded-lg focus:outline-none focus:shadow-outline-gray transform hover:scale-150 transition ease-in-out duration-150"
                                                        aria-label="Delete" type="submit">
                                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
