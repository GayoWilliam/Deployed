@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-kenchic-blue']) }}>
    {{ $value ?? $slot }}
</label>
