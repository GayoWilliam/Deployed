<x-admin-layout>
    <x-slot name="header">
        {{ __('Roles') }}
    </x-slot>

    <div class="w-full">
        <div x-data="" class="w-full mx-auto sm:px-6 lg:px-8 bg-transparent rounded-md px-8 py-3 overflow-y-auto">
            <!-- Create role Modal -->
            <x-modal name="create-role" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="POST" action="{{ route('admin.roles.store') }}" class="p-6">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Create Role -->
                        <div class="w-full md:w-1/2 px-3 md:mb-0">
                            <x-label-auth for="name" :value="__('Role Name')" />
                            <x-text-input-auth name="name" type="text" class="mt-1 block w-full"
                                placeholder="Role name must not exist" value="{{ old('name') }}" required
                                autofocus />
                        </div>

                        <div class="w-full md:w-1/2 px-3 md:mb-0">
                            <x-label-auth for="role_description" :value="__('Role Description')" />
                            <x-text-input-auth name="role_description" type="text" class="mt-1 block w-full"
                                placeholder="Brief description of the role" value="{{ old('role_description') }}"
                                required autofocus />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-full px-3 md:mb-0 space-y-4">
                            <label class="block text-xl text-kenchic-blue normalcase leading-tight">
                                Assign permissions to role
                            </label>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach ($permissions as $permission)
                                    <div
                                        class="capitalize col-span-4 sm:col-span-2 md:col-span-1 block leading-tight text-sm mb-2">
                                        <x-label-auth class="form-check-label">
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                                class="form-checkbox text-kenchic-blue border-2 border-kenchic-blue rounded h-4 w-4 mr-2">
                                            {{ $permission->name }}
                                        </x-label-auth>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end w-full">
                        <x-primary-button class="w-full">
                            {{ __('Create') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>

            <div class="flex justify-between items-center mb-5">
                <div class="relative">
                    <form class="relative" action="{{ route('admin.roles.index') }}" method="GET">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-kenchic-blue" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <x-text-input-auth type="text" id="table-search-role" class="block p-2 pl-10"
                            placeholder="Search for Role" name="search" value="{{ request('search') }}"
                            autofocus />
                    </form>
                </div>
                @can('add role')
                    <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'create-role')">
                        {{ __('Add Role') }}
                    </x-primary-button>
                @endcan
            </div>

            <!-- Roles table -->
            <div class="w-full overflow-hidden rounded-md shadow-lg shadow-kenchic-blue">
                <div class="scrollbar-hide w-full overflow-y-auto max-h-screen">
                    <table class="w-full whitespace-no-wrap max-h-screen">
                        <thead>
                            <tr
                                class="sticky top-0 z-10 text-[10px] text-left text-kenchic-gold uppercase border-b-2 border-kenchic-gold bg-kenchic-blue">
                                <th class="px-4 py-4">Role</th>
                                <th class="px-4">Role Description</th>
                                <th class="px-4">Role Permissions</th>
                                <th class="px-4">Assign Permissions</th>
                                <th class="px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-transparent divide-kenchic-blue divide-opacity-10 divide-y">
                            @foreach ($roles as $role)
                                <tr class="hover:bg-kenchic-blue transition ease-in-out duration-150 leading-tight group">
                                    @if ($role->name == 'Super Admin')
                                        <td class="py-5 px-4">
                                            <x-label-auth class="group-hover:text-kenchic-gold"
                                                value="{{ $role->name }}" />
                                        </td>
                                        <td class="px-4">
                                            <x-label-auth class="group-hover:text-kenchic-gold"
                                                value="{{ $role->role_description }}" />
                                        </td>
                                        <td class="px-4">
                                            <x-label-auth class="group-hover:text-kenchic-gold"
                                                value="Has all permissions" />
                                        </td>
                                        <td class="px-4">
                                            <x-label-auth class="group-hover:text-kenchic-gold"
                                                value="Cannot assign permissions" />
                                        </td>
                                        <td class="px-4">
                                            <x-label-auth class="group-hover:text-kenchic-gold"
                                                value="Cannot delete role" />
                                        </td>
                                    @else
                                        <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <td class="px-4">
                                                <x-text-input name="name" onchange="this.form.submit()"
                                                    type="text"
                                                    class="mb-2 group-hover:text-kenchic-gold group-hover:shadow-kenchic-gold"
                                                    value=" {{ $role->name }}" />
                                            </td>
                                            <td class="px-4">
                                                <x-text-input name="role_description" onchange="this.form.submit()"
                                                    type="text"
                                                    class="mb-2 group-hover:text-kenchic-gold group-hover:shadow-kenchic-gold"
                                                    value=" {{ $role->role_description }}" />
                                            </td>
                                        </form>

                                        <td>
                                            <div class="grid grid-cols-3 gap-4 p-4">
                                                @foreach ($role->permissions->sortBy('name') as $role_permission)
                                                    <form method="POST"
                                                        action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                                        onsubmit="return confirm('Are you sure you want to remove {{ $role_permission->name }} permission from role {{ $role->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button
                                                            class="w-full place-content-center"
                                                            aria-label="Delete" type="submit">
                                                            {{ $role_permission->name }}
                                                        </x-danger-button>
                                                    </form>
                                                @endforeach
                                            </div>
                                        </td>

                                        <td class="py-2 px-4">
                                            <form method="POST" id="permissionForm"
                                                action="{{ route('admin.roles.permissions', $role->id) }}">
                                                @csrf
                                                <div class="">
                                                    <select id="permission" name="permission"
                                                        autocomplete="permission-name" onchange="this.form.submit()"
                                                        class="text-xs block w-full bg-transparent rounded-md border-none focus:border-none hover:border-transparent
                                                            shadow-sm shadow-kenchic-blue hover:shadow-lg hover:shadow-kenchic-gold group-hover:text-kenchic-gold group-hover:shadow-kenchic-gold group-hover:focus:shadow-kenchic-gold
                                                            focus:shadow-md focus:shadow-kenchic-blue ring-0 focus:ring-0 transition ease-in-out duration-150">
                                                        <option disabled selected>
                                                            Select permission
                                                        </option>
                                                        @foreach ($permissions as $permission)
                                                            <option value="{{ $permission->name }}">
                                                                {{ $permission->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </form>
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4">
                                                <!-- Delete Role -->
                                                <form method="POST"
                                                    action="{{ route('admin.roles.destroy', $role->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete {{ $role->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="flex items-center justify-between text-kenchic-red focus:outline-none focus:shadow-outline-gray transform hover:scale-125"
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
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
