@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-xs text-kenchic-blue normalcase leading-tight']) }}>
    {{ $value ?? $slot }}
</label>
