<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="flex flex-col items-center max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="font-custom1 text-4xl p-6 text-gray-900">
                    {{ __("Vítejte na MAPY!") }}
                </div>

            </div>

                <div class="size-1/2 mt-8">
                    <a href="/">
                        <img src='images/vecteezy_africa-safari-map-1000x785.png'>
                    </a>   
                </div>
                
                <a href="https://www.vecteezy.com/free-png/street-map" target="_blank" class="hover:text-gray-500 pr-12">Street Map PNGs by Vecteezy</a>
        </div>

    </div>

</x-app-layout>
