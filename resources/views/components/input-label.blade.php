@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-xl text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
