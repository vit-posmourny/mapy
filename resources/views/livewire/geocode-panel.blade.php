<div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <form wire:submit.prevent="store" class="flex flex-col">

        <div class="grid grid-cols-12 items-baseline mb-4">
            <span class="select-none col-span-3">něco:</span><x-text-input id="i-search-field" wire:model="latitude" name="search-field" placeholder="něco" class="col-span-9"/>
        </div>
        
    </form>
   
</div>
