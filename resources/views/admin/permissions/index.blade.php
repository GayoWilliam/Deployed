<x-admin-layout>
    <x-slot name="header">
        {{ __('Permissions') }}
    </x-slot>
    <div class="w-full mx-auto sm:px-6 lg:px-8 bg-transparent rounded-md px-8 py-3 overflow-y-auto">
        <!-- Permissions Search -->
        <div class="flex justify-between items-center mb-5">
            <div class="relative rounded-md border-transparent">
                <form class="relative" action="{{ route('admin.permissions.index') }}" method="GET">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-text-input-auth type="text" id="table-search-users" class="block p-2 pl-10"
                        placeholder="Search for Permission" name="search" value="{{ request('search') }}" autofocus />
                </form>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-md shadow-lg shadow-kenchic-blue">
            <div class="scrollbar-hide w-full overflow-y-auto max-h-screen">
                <table class="w-full whitespace-no-wrap max-h-screen">
                    <thead>
                        <tr
                            class="sticky top-0 z-10 text-[10px] text-kenchic-gold text-left uppercase border-b-2 border-kenchic-gold bg-kenchic-blue">
                            <th class="px-4 py-4">Permission</th>
                            <th class="px-4">Permission Description</th>
                        </tr>
                    </thead>
                    <tbody class="bg-transparent divide-kenchic-blue divide-opacity-10 divide-y">
                        @foreach ($permissions as $permission)
                            <tr
                                class="hover:bg-kenchic-blue group hover:text-kenchic-gold transition ease-in-out duration-150 leading-tight">
                                <td class="px-4 py-3 text-xs">
                                    {{ $permission->name }}
                                </td>
                                <td class="px-4 text-xs">
                                    {{ $permission->permission_description }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>