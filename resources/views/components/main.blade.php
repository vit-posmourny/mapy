@php
$classes = request()->path() == 'dashboard'
            ? 'h-[92.5vh] lg:h-auto flex landscape:flex portrait:flex-col lg:justify-center'
            : 'h-[92.5vh] flex landscape:flex portrait:flex-col lg:justify-center';       
@endphp

<main  {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</main>