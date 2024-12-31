<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center py-4 text-2xl font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 ring-inset focus:ring-green-800']) }}>
    
    <div class="flex inline-flex">

        <span> {{ $slot }} </span> <img class="w-8 h-8 absolute right-12 animate-spin" wire:loading.delay.short src="images\loading spinner.svg"> 

    </div>

</button>