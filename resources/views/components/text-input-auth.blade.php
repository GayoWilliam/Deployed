@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-xs font-semibold text-kenchic-blue placeholder:text-kenchic-blue placeholder:text-opacity-70 bg-transparent rounded-md border-none hover:border-transparent focus:border-transparent
                                                                            shadow-sm hover:shadow-lg focus:shadow-md shadow-kenchic-blue hover:shadow-kenchic-blue 
                                                                            focus:shadow-kenchic-blue focus:ring-0 transition ease-in-out duration-150 mt-2 block w-full']) !!}>
