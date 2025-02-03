<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center p-4 text-xl sm:p-3 sm:text-sm lg:p-4 lg:text-2xl font-medium tracking-wide text-green-500 transition-colors duration-200 rounded-lg sm:rounded-md lg:rounded-lg focus:ring-2 ring-inset focus:ring-green-300 bg-green-100 hover:text-green-600 hover:bg-green-150']) }}>
    {{ $slot }}
</button>
