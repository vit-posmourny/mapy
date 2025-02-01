<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-md lg:text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="portrait:pt-20 py-4 lg:py-12">

        <div class="flex flex-col items-center max-w-7xl mx-auto px-2 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="portrait:text-center font-custom1 text-2xl lg:text-4xl p-6 text-gray-900">
                    {{ __("Vítejte na MAPY!") }}
                </div>

            </div>

                <div class="size-1/3 lg:size-1/2 mt-8">
                    <a href="/">
                        {{-- <img src="images/vecteezy_africa-safari-map-1000x785.png"/> --}}
                        <img src='images/vecteezy_africa-safari-map-1000x785.png'>
                    </a>   
                </div>
                
                <a href="https://www.vecteezy.com/free-png/street-map" target="_blank" class="hover:text-gray-500 text-xs lg:text-sm">Street Map PNGs by Vecteezy</a>
        </div>

    </div>

</x-app-layout>
