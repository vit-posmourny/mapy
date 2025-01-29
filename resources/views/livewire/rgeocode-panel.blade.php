<div class="w-1/4 portrait:w-full shadow-2xl p-2 lg:p-8 text-xl font-medium overflow-hidden lg:min-w-96">

    <form wire:submit.prevent="store" class="flex flex-col">
        @csrf
        {{-- můžu přdat atribut readonly --}}
        <div class="grid grid-cols-12 items-baseline lg:mb-4">
            <span class="hidden lg:inline select-none col-span-3">Druh:</span><x-text-input id="i-label" wire:model="label" name="label" placeholder="Druh" class="col-span-12 lg:col-span-9"/>
        </div>
        
            <x-input-error class="self-start ml-14" :messages="$errors->get('label')"/>

        <div class="grid grid-cols-12 items-baseline my-2 lg:my-4">        
            <span class="hidden lg:inline select-none col-span-3">Lokace:</span><x-text-input id="i-location" wire:model="location" name="location" placeholder="Lokace" class="col-span-12 lg:col-span-9"/> 
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('location')"/>

        <div class="grid grid-cols-12 items-baseline lg:my-4">
            <span class="hidden lg:inline select-none col-span-3">Název:</span><x-text-input id="i-name" wire:model="name" name="name" placeholder="Název" class="col-span-12 lg:col-span-9"/>
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('name')"/>

        <div class="grid grid-cols-12 items-baseline mt-2 mb-4 lg:my-4">
            <span class="hidden lg:inline select-none col-span-3">PSČ:</span><x-text-input id="i-zip" wire:model="zip" name="zip" placeholder="PSČ" class="col-span-12 lg:col-span-9"/>
        </div>

            <x-input-error class="self-start ml-14" :messages="$errors->get('zip')"/>
 
            <x-submit-button class="portrait:block portrait:mb-2 hidden lg:block mt-4 lg:mb-4">Uložit do databáze</x-submit-button>

            <x-submit-button class="portrait:hidden lg:hidden mt-4 mb-2"><img src="images\svg\database_upload_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg"/></x-submit-button>

    </form>

        <div x-data="{ open: false }">
            
            <x-primary-button x-on:click="open = true" wire:click='readData' class="w-full hidden portrait:block lg:block">
                    Uložená místa
            </x-primary-button>

            <x-primary-button x-on:click="open = true" wire:click='readData' class="w-full portrait:hidden lg:hidden">
                <img src="images\svg\database_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg"/>
                <img src="images\svg\chevron_right_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg"/>
                <img src="images\svg\table_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg"/>
            </x-primary-button>
            
            @livewire('modal-table', ['data' => $data])
            {{-- musí tu být wire:model --}}
            <livewire:modal-table  open="$open" wire:model='data'/>

        </div>
   
</div>
