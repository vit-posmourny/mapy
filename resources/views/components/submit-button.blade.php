<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center py-4 text-2xl font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 ring-inset focus:ring-green-800']) }}>

    <div class="inline-flex items-center portrait:grid portrait:grid-cols-12 portrait:items-baseline lg:grid lg:grid-cols-12 lg:items-baseline"> 

        <span class="col-span-2"></span><span class="col-span-8"> {{ $slot }} </span>  

        @if (session('store_success'))

            <img class="lg:col-span-2 portrait:self-center lg:self-center w-6 h-6 lg:w-8 lg:h-8 ml-2 animate-[ping_1s_ease-in-out_1]" src="{{ Vite::svg('checkmark-svgrepo-com.svg') }}">
        @else
            <img class="lg:col-span-2 portrait:self-center lg:self-center w-6 h-6 lg:w-8 lg:h-8 ml-2 animate-spin" wire:loading.delay src="{{ Vite::svg('loading spinner.svg') }}">
        @endif

    </div>

</button>


