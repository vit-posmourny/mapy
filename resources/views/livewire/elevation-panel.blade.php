<div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <form wire:submit.prevent="store" class="flex flex-col">
        {{-- můžu přdat atribut readonly --}}
        <div class="grid grid-cols-12 items-baseline mb-4">
            <span class="select-none col-span-2">Lat:</span><x-text-input id="i-Latitude" wire:model="latitude" name="latitude" placeholder="Enter Latitude" class="col-span-10"/>
        </div>
        
            <x-input-error class="self-start ml-14" :messages="$errors->get('latitude')"/>

        <div class="grid grid-cols-12 items-baseline my-4">        
            <span class="select-none col-span-2">Lon:</span><x-text-input id="i-Longitude" wire:model="longitude" name="longitude" placeholder="Enter Longitude" class="col-span-10"/> 
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('longitude')"/>

        <div class="grid grid-cols-8 items-baseline my-4">
            <span class="select-none col-span-3">Elevation:</span><x-text-input id="i-Elevation" wire:model="elevation" name="elevation" placeholder="Enter Elevation" class="col-span-4 text-right"/><span class="select-none col-span-1 text-right">m</span>
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('elevation')"/>
        
            <x-submit-button class="mt-4">Store to database</x-submit-button>

    </form>
   
</div>