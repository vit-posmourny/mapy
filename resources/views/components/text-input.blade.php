@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-lg border-yellow-800 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-800 dark:focus:border-yellow-800 focus:ring-yellow-900 ring-1 focus:ring-2 ring-yellow-700 dark:focus:ring-indigo-600 rounded-md shadow-2xl']) }}>
