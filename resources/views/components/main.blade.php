@php
switch (request()->path()) {

    case 'dashboard':
        $classes = 'h-[92.5vh] lg:h-auto flex landscape:flex portrait:flex-col lg:justify-center';
        break;

    case 'profile':
        $classes = 'h-[92.5vh] flex landscape:flex landscape:mx-auto landscape:w-3/4 landscape:place-content-center portrait:flex-col lg:justify-center';
        break;
    
    default:
        $classes = 'h-[92.5vh] flex landscape:flex portrait:flex-col lg:justify-center';
        break;
}      
@endphp

<main  {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</main>