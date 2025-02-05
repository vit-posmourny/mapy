<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 text-2xl font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 ring-inset focus:ring-green-800']) }}>
   
        @if (session()->has('success'))
            <img class="w-8 h-8 animate-[ping_0.5s_ease-in-out_1]" src="images\svg\delete_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg">
        @else
            <img class="w-8 h-8" src="images\svg\delete_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg">
        @endif

</button>