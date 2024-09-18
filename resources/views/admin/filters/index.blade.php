<x-admin-layout>
    <x-slot name="header">
        {{ __('Data Filters') }}
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
                            placeholder="Search for Filter" name="search" value="{{ request('search') }}" autofocus />
                    </form>
                </div>

                @can('add filters')
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-filters')">
                        {{ __('Add Filters') }}
                    </x-primary-button>
                @endcan

                <x-modal name="add-filters" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="POST" action="{{ route('admin.filters.store') }}" class="p-6">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3 md:mb-0">
                                <x-label-auth for="table_name" :value="__('Table Name')" />
                                <x-text-input-auth name="table_name" type="text"
                                    class="@error('table_name') is-invalid @enderror" placeholder="e.g., Students"
                                    value="{{ old('table_name') }}" required autofocus />
                            </div>

                            <div class="w-full md:w-1/3 px-3 md:mb-0">
                                <x-label-auth for="column_name" :value="__('Column Name')" />
                                <x-text-input-auth name="column_name" type="text"
                                    class="@error('column_name') is-invalid @enderror" value="{{ old('column_name') }}"
                                    placeholder="e.g., Name" required autofocus />
                            </div>

                            <div class="w-full md:w-1/3 px-3 md:mb-0">
                                <x-label-auth for="column_value" :value="__('Column Value')" />
                                <x-text-input-auth name="column_value" type="text"
                                    class="@error('column_value') is-invalid @enderror" value="{{ old('column_value') }}"
                                    placeholder="e.g., John, Jane, Doe" required autofocus />
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

            <!-- Data Filters table -->
            <div class="w-full overflow-y-auto rounded-md shadow-lg shadow-kenchic-blue">
                <div class="scrollbar-hide w-full overflow-y-auto max-h-screen">
                    <table class="w-full whitespace-no-wrap max-h-screen">
                        <thead>
                            <tr class="sticky top-0 z-10 text-[10px] text-left text-kenchic-gold uppercase bg-kenchic-blue border-b-2 border-kenchic-gold">
                                <th class="px-4 py-4">Table</th>
                                <th class="px-4">Column</th>
                                <th class="px-4">Possible Values</th>
                                @can('delete filters')
                                    <th class="px-4">Action</th>
                                @endcan
                            </tr>
                        </thead>

                        <tbody class="bg-transparent divide-kenchic-blue divide-opacity-10 divide-y text-xs">
                            @foreach ($filters as $filter)
                                <tr
                                    class="hover:bg-kenchic-blue group hover:text-kenchic-gold transition ease-in-out duration-150 leading-tight">
                                    <td class="px-4 py-4">
                                        <p>{{ $filter->table_name }}</p>
                                    </td>

                                    <td class="px-4">
                                        <p>{{ $filter->column_name }}</p>
                                    </td>

                                    <td class="px-4">
                                        <p>{{ implode(', ', json_decode($filter->possible_values, true)) }}</p>
                                    </td>
                                    
                                    @can('delete filters')
                                        <td class="px-4">
                                            <div class="flex items-center space-x-4 text-xs">
                                                <form method="POST" action="{{ route('admin.filters.destroy', $filter->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete {{ $filter->table_name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="flex items-center justify-between text-kenchic-red rounded-lg focus:outline-none focus:shadow-outline-gray transform hover:scale-150 transition ease-in-out duration-150"
                                                        aria-label="Delete" type="submit">
                                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
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
