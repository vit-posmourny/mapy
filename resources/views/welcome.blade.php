<!-- resources\views\welcome.blade.php -->
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mapy</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="flex flex-col h-screen font-sans antialiased">
       
        <header class="flex-initial sm:mb-12 lg:mb-2 mb-28 justify-items-center lg:justify-items-end">
            
            @if (Route::has('login'))
                <nav class="flex gap-8 lg:mr-[3vw]">
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            <x-secondary-button>Dashboard</x-secondary-button>
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <x-secondary-button>Přihlásit</x-primary-button>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                <x-secondary-button>Registrovat</x-secondary-button>
                            </a>
                        @endif
                        
                    @endauth
                </nav>
            @endif

        </header>

        <main class="flex flex-col sm:size-1/3 lg:size-1/2 portrait:size-3/4 self-center lg:h-auto lg:w-auto">

             <img src="images/vecteezy_africa-safari-map-1000x785.png"/>
             <a href="https://www.vecteezy.com/free-png/street-map" target="_blank" class="hover:text-gray-500 self-center text-xs lg:text-lg">Street Map PNGs by Vecteezy</a>
                
        </main>

    </body>
        @livewireScripts
</html>
