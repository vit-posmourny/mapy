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
    <body class="h-screen font-sans antialiased dark:bg-black dark:text-white/50">
       
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            
            @if (Route::has('login'))
                <nav class="flex flex-1 justify-evenly">
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            <x-secondary-button>Dashboard</x-secondary-button>
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <x-primary-button>Přihlásit</x-primary-button>
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

        <main class="mt-6">
            
        </main>

    </body>
</html>
