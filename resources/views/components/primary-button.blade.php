<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-4 text-2xl font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-700 focus:shadow-outline focus:outline-none']) }}>
    {{ $slot }}
</button>
