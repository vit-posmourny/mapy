<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-4 text-2xl font-medium tracking-wide text-green-500 transition-colors duration-200 rounded-lg focus:ring-2 ring-inset focus:ring-green-300 bg-green-100 hover:text-green-600 hover:bg-green-150']) }}>
    {{ $slot }}
</button>
