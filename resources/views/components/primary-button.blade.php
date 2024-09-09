<button {{ $attributes->merge(['type' => 'submit', 'class' => 'font-semibold text-xs bg-kenchic-blue hover:bg-kenchic-gold text-kenchic-gold hover:text-kenchic-blue focus:ring-0 focus:outline-none rounded-md px-4 py-2 text-center transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>