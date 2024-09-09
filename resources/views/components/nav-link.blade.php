@props(['active'])

@php
    $classes = $active ?? false ? 'uppercase antialiased leading-tight text-xs font-semibold text-kenchic-red focus:outline-none transition duration-150 ease-in-out' : 'uppercase antialiased leading-tight text-xs font-semibold leading-tight text-kenchic-blue hover:text-kenchic-red focus:outline-none focus:text-kenchic-red transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>