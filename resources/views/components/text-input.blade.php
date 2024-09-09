@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-xs text-kenchic-blue placeholder:text-kenchic-blue placeholder:text-opacity-70 font-semibold bg-transparent border-none 
                                                                             hover:shadow-lg focus:shadow-md shadow-sm shadow-kenchic-blue hover:shadow-kenchic-blue focus:shadow-kenchic-blue
                                                                             focus:ring-0 hover:border-transparent focus:border-transparent focus:border-transparent 
                                                                             rounded-md transition ease-in-out duration-150 mt-2 block w-full']) !!}>