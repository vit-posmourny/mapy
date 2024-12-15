<div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <form wire:submit.prevent="store" class="flex flex-col gap-8">
        
        <div class="grid grid-cols-8 items-baseline align-between gap-4 ooverflow-hidden">
            <span class="select-none">Lat:</span><x-text-input id="latitude" wire:model="latitude" name="latitude" class="col-span-7"/>
            <x-input-error :messages="$errors->get('latitude')" class="mt-2"/>
{{--               @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif --}}
                
            <span class="select-none">Lon:</span><x-text-input id="longitude" wire:model="longitude" name="longitude" class="col-span-7"/> 
            <span class="select-none col-span-3">Elevation:</span><x-text-input id="elevation" wire:model="elevation" name="elevation" class="col-span-4 text-right"/><span class="select-none col-span-1 text-right">m</span>
        </div>

            <x-primary-button>Store to database</x-primary-button>

    </form>

</div>