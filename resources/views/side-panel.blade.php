<div class="flex flex-col gap-8 w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <div class="grid grid-cols-8 items-baseline align-between gap-4 ooverflow-hidden">

        <span class="select-none">Lat:</span><x-text-input type="text" name="latitude" class="col-span-7"/>
        <span class="select-none">Lon:</span><x-text-input type="text" name="longitude" class="col-span-7"/> 
        <span class="select-none">Ele:</span><x-text-input type="text" name="elevation" class="col-span-7"/>

    </div>

        <x-primary-button>Ulozit do databaze</x-primary-butto>

</div>