<div>
    // jsem livewire side panel
    <div class="w-1/4 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <!-- <form action="/elevation/store" method="POST" class="flex flex-col gap-8"> -->
        @csrf
        <div class="grid grid-cols-8 items-baseline align-between gap-4 ooverflow-hidden">
            <span wire:model ="SidePanel">{{$count}}</span>
            <span class="select-none">Lat:</span><x-text-input id="i-latitude" type="text" name="latitude" class="col-span-7"/>
            <span class="select-none">Lon:</span><x-text-input id="i-longitude" type="text" name="longitude" class="col-span-7"/> 
            <span class="select-none col-span-3">Elevation:</span><x-text-input id="i-elevation" type="text" name="elevation" class="col-span-4 text-right"/><span class="select-none col-span-1 text-right">m</span>
        </div>

            <button wire:click = "increment">Store to database</button>

    <!-- </form> -->

</div>
</div>