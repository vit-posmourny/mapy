<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-4 text-2xl font-medium tracking-wide text-green-500 transition-colors duration-100 rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-green-100 bg-green-50 hover:text-green-600 hover:bg-green-100']) }}>
    {{ $slot }}
</button>
