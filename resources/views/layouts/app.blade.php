<!-- resources\views\layouts\app.blade.php -->
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- StyleSheets --}}
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=alex-brush:400|allison:400|bevan:400">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@^5.0.0/dist/maplibre-gl.css"/>
        <!-- Scripts -->
        <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/maplibre-gl@^5.0.0/dist/maplibre-gl.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/autoComplete.css', 'resources/css/webkit.css'])
        <!-- livewireStyles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white">
                    <div class="max-w-7xl mx-auto py-4 lg:py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <x-main>

                {{$slot}}

                @if (request()->path() == 'elevation')

                    <livewire:elevation-panel/>
                    <script src="{{ Vite::asset('resources/js/elevation.js') }}"></script>

                @elseif (request()->path() == 'rgeocode')

                    <livewire:rgeocode-panel/>
                    <script src="{{ Vite::asset('resources/js/rgeocode.js') }}"></script> 

                @elseif (request()->path() == 'geocode')
                
                    <livewire:geocode-panel/>
                    <script src="{{ Vite::asset('resources/js/geowhisper.js') }}"></script>

                @endif

            </x-main>
    </body>
        @livewireScripts
</html>