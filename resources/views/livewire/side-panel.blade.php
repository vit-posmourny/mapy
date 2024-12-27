<div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    
    <script src="js/map.js"></script>

    <form   wire:submit.prevent="store" class="flex flex-col">
        
        <div class="grid grid-cols-7 items-baseline mb-4">
            <span class="select-none">Lat:</span><x-text-input id="inputLatitude" x-ref="latitude" wire:model="latitude"  name="latitude" placeholder="Enter Latitude" class="col-span-6" />
        </div>
        
            <span>{{$latitude}}</span>
            <x-input-error class="self-start ml-14" :messages="$errors->get('latitude')"/>

        <div class="grid grid-cols-7 items-baseline my-4">        
            <span class="select-none">Lon:</span><x-text-input id="inputLongitude" x-ref="longitude" wire:model="longitude" name="longitude" placeholder="Enter Longitude" class="col-span-6"/> 
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('longitude')"/>

        <div class="grid grid-cols-8 items-baseline my-4">
            <span class="select-none col-span-3">Elevation:</span><x-text-input id="inputElevation" x-ref="elevation" wire:model="elevation" name="elevation" placeholder="Enter Elevation" class="col-span-4 text-right"/><span class="select-none col-span-1 text-right">m</span>
        </div>

        <span id="i-span" @latitude-updated="window.dispatchEvent(new CustomEvent('latitude-updated', {
            detail: {
              latitude: $refs.latitude.value,
              longitude: $refs.longitude.value,
              elevation: $refs.elevation.value,
            }
          }));"></span>

            <x-input-error class="self-start ml-14" :messages="$errors->get('elevation')"/>
        
        <x-primary-button class="mt-4">Store to database</x-primary-button>

        @if (session()->has('success'))
            <div class='self-center text-lg text-green-600 space-y-1'>{{ session('success') }}</div>
        @endif

    </form>
   
</div>