@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2 mt-2 text-xs font-semibold leading-tight rounded-md bg-kenchic-gold text-kenchic-blue hover:text-kenchic-blue antialiased focus:text-kenchic-gold focus:outline-none focus:shadow-outline'
            : 'block px-4 py-2 mt-2 text-xs font-semibold leading-tight bg-transparent rounded-md transition ease-in-out duration-300 antialiased text-kenchic-gold hover:bg-kenchic-gold hover:text-kenchic-blue focus:outline-none focus:shadow-outline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
