<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center py-4 text-2xl font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 ring-inset focus:ring-green-800']) }}>
    
    <div class="flex inline-flex">

         

        @if (session()->has('success'))
            <img class="w-8 h-8 absolute right-12 animate-[ping_1s_ease-in-out_1]" src="images\svg\checkmark-svgrepo-com.svg">
        @else
            <img class="w-8 h-8 absolute right-12 animate-spin" wire:loading.delay src="images\svg\loading spinner.svg">
        @endif

    </div>

</button>