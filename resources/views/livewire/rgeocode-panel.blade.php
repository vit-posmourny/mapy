<div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <form wire:submit.prevent="store" class="flex flex-col">
        {{-- můžu přdat atribut readonly --}}
        <div class="grid grid-cols-12 items-baseline mb-4">
            <span class="select-none col-span-3">Druh:</span><x-text-input id="i-label" wire:model="label" name="label" placeholder="Druh" class="col-span-9"/>
        </div>
        
            <x-input-error class="self-start ml-14" :messages="$errors->get('label')"/>

        <div class="grid grid-cols-12 items-baseline my-4">        
            <span class="select-none col-span-3">Lokace:</span><x-text-input id="i-location" wire:model="location" name="location" placeholder="Lokace" class="col-span-9"/> 
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('location')"/>

        <div class="grid grid-cols-12 items-baseline my-4">
            <span class="select-none col-span-3">Název:</span><x-text-input id="i-name" wire:model="name" name="name" placeholder="Název" class="col-span-9"/>
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('name')"/>

        <div class="grid grid-cols-12 items-baseline my-4">
            <span class="select-none col-span-3">PSČ:</span><x-text-input id="i-zip" wire:model="zip" name="zip" placeholder="PSČ" class="col-span-9"/>
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('zip')"/>
        
            <x-submit-button class="mt-4">Uložit do databáze</x-submit-button>

    </form>
   
</div>
