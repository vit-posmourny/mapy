<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-4 text-2xl font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 ring-inset focus:ring-green-800']) }}>
    {{ $slot }}
</button>
