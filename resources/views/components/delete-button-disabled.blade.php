<button disabled {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 text-2xl font-medium tracking-wide text-white bg-green-600 opacity-50 rounded-lg']) }}>
    
    {{ session()->flash('delete_success', false); }}
    @if (session('delete_success'))
    
    <img class="w-8 h-8 animate-[ping_0.5s_ease-in-out_1]" src="{{ Vite::svg('delete_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg') }}">
    
        @else
            <img class="w-8 h-8" src="{{ Vite::svg('delete_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg') }}">
        @endif
  
</button>