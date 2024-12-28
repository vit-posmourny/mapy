<div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <form  wire:submit.prevent="store" class="flex flex-col">
        
        <div class="grid grid-cols-12 items-baseline mb-4">
            <span class="select-none col-span-2">Lat:</span><x-text-input id="inputLatitude" x-ref="latitude" wire:model="latitude"  name="latitude" placeholder="Enter Latitude" class="col-span-10" />
        </div>
        
            <x-input-error class="self-start ml-14" :messages="$errors->get('latitude')"/>

        <div class="grid grid-cols-12 items-baseline my-4">        
            <span class="select-none col-span-2">Lon:</span><x-text-input id="inputLongitude" x-ref="longitude" wire:model="longitude" name="longitude" placeholder="Enter Longitude" class="col-span-10"/> 
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('longitude')"/>

        <div class="grid grid-cols-8 items-baseline my-4">
            <span class="select-none col-span-3">Elevation:</span><x-text-input id="inputElevation" x-ref="elevation" wire:model="elevation" name="elevation" placeholder="Enter Elevation" class="col-span-4 text-right"/><span class="select-none col-span-1 text-right">m</span>
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('elevation')"/>
        
        <x-primary-button class="mt-4">Store to database</x-primary-button>

        @if (session()->has('success'))
            <div class='self-center text-lg text-green-600 space-y-1'>{{ session('success') }}</div>
        @endif

    </form>
   
</div>