@props(['disabled' => false])


<input @disabled($disabled) {{ $attributes->merge(['type' => 'text', 'class' => 'text-lg bg-light_wood border-yellow-800 focus:border-yellow-800 focus:ring-yellow-900 ring-1 focus:ring-2 ring-yellow-700 rounded-md shadow-xl']) }}>
