<div class="w-1/4 portrait:w-full shadow-2xl p-2 lg:p-8 text-xl font-medium overflow-hidden lg:min-w-96">

    <form wire:submit.prevent="store" class="flex flex-col">
        {{-- můžu přdat atribut readonly --}}
        <div class="grid grid-cols-12 items-baseline lg:mb-4">
            <span class="hidden lg:inline select-none col-span-3">z.šířka:</span><x-text-input id="i-Latitude" wire:model="latitude" name="latitude" placeholder="šířka" class="col-span-12 lg:col-span-9"/>
        </div>
        
            <x-input-error class="self-start ml-14" :messages="$errors->get('latitude')"/>

        <div class="grid grid-cols-12 items-baseline my-2 lg:my-4">       
            <span class="hidden lg:inline select-none col-span-3">z.délka:</span><x-text-input id="i-Longitude" wire:model="longitude" name="longitude" placeholder="délka" class="col-span-12 lg:col-span-9"/> 
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('longitude')"/>

        <div class="grid grid-cols-8 items-baseline mb-4 lg:my-4">
            <span class="hidden lg:inline select-none col-span-3">nadm.výška:</span><x-text-input id="i-Elevation" wire:model="elevation" name="elevation" placeholder="výška" class="custom_input col-span-12 lg:col-span-4"/><span class="hidden select-none lg:col-span-1 text-right">m</span>
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('elevation')"/>
        
            {{-- buttons --}}
            <x-submit-button class="hidden mt-4 portrait:block portrait:mb-2 lg:block lg:mb-4">Uložit do databáze</x-submit-button>

            <x-submit-button class="mt-4 mb-2 portrait:hidden lg:hidden"><img src="images\svg\database_upload_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg"/></x-submit-button>

    </form>
   
</div>