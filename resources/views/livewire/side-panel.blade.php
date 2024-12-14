
    
    <div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

        <form wire:submit.prevent="store" class="flex flex-col gap-8">
            <!-- @csrf -->
            <div class="grid grid-cols-8 items-baseline align-between gap-4 ooverflow-hidden">
                <span class="select-none">Lat:</span><x-text-input id="latitude" type="text" wire:model="latitude" name="latitude" class="col-span-7"/>
                <span class="select-none">Lon:</span><x-text-input id="longitude" type="text" wire:model="longitude" name="longitude" class="col-span-7"/> 
                <span class="select-none col-span-3">Elevation:</span><x-text-input id="elevation" type="text" wire:model="elevation" name="elevation" class="col-span-4 text-right"/><span class="select-none col-span-1 text-right">m</span>
            </div>

                <x-primary-button type="submit">Store to database</x-primary-button>

        </form>

    </div>