{{-- livewire\modal-table.blade.php --}}
<div x-cloak x-show="open" x-on:click="open = false" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-gray-400 bg-opacity-50" x-transition>
    {{-- @click.stop="" on the modal content: This is crucial. It prevents the click event from bubbling up to the overlay, so clicks inside the modal don't close it. --}}
    <div class=" portrait:w-screen bg-white max-w-2xl lg:max-w-fit rounded-lg shadow-lg p-2" @click.stop="" @keydown.escape.window="open = false">
        <!-- Header -->
        <div class="relative flex justify-between px-3 pt-1 h-8">

            <h2 class="text-xl font-bold select-none">Uložená místa</h2>
            {{-- TODO: přidat kolem X šedé kolečko při hoveru --}}
            <div class="absolute size-8 rounded-md top-0 right-0 mr-1 p-1 hover:bg-zinc-100">
                <svg x-on:click="open = false" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="stroke-zinc-600 hover:stroke-zinc-950">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>

        </div>

        <template x-if="open">

            @if (session('readData_success') === true)
    |       
                <div class="mt-2">

                    <div class="max-h-[50vh] lg:max-h-[25vh] overflow-y-auto modal_table">
                        <!-- Table -->
                        <table id="modal-table" class="text-base border-collapse border border-slate-400 w-auto">

                            <thead class="font-bold text-lg text-green-900 bg-green-200 w-12">
                                <tr>
                                    <th class="border px-2 border-slate-400">Id</th>
                                    <th class="border px-2 border-slate-400">Druh</th>
                                    <th class="border px-2 border-slate-400">Lokace</th>
                                    <th class="border px-2 border-slate-400">Název</th>
                                    <th class="border px-2 border-slate-400">PSČ</th>
                                    <th class="border px-2 border-slate-400">Země</th>
                                    <th class="border px-2 border-slate-400">Z.Šířka</th>
                                    <th class="border px-2 border-slate-400">Z.Délka</th>
                                </tr>
                            </thead>
                    
                            <tbody class="text-nowrap">
                                @foreach ($data as $row)
                                    <tr x-on:click="if (shiftPressed && $store.Row.lastClickedRowId) {
                                                        $store.Row.selectRange($store.Row.lastClickedRowId, {{ $row['id'] }});
                                                    } else {
                                                        $store.Row.pushRowIds({{ $row['id'] }});
                                                    }" 
                                        data-row-ids="{{$row['id']}}" :class="$store.Row.findRowId({{$row['id']}}) ? 'bg-green-100': ''">
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['id'] }}</td>
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['label'] }}</td>
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['location'] }}</td>
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['name'] }}</td>
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['zip'] }}</td>
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['isoCode'] }}</td>
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['latitude'] }}</td>
                                        <td class="border text-center px-2 border-slate-400 select-none">{{ $row['longitude'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    
                        </table>

                    </div>
                    <!-- Modal buttons -->
                    <div class="flex mt-4 justify-end">
                        <template x-if="disabled">
                            {{-- disabled Delete button  --}}
                            <x-delete-button-disabled class="mb-1"></x-delete-button-disabled>
                            
                        </template>
                        <template x-if="!disabled">
                            {{-- Delete button  --}}
                            <x-delete-button wire:click="delete($store.Row.rowIds)" x-on:click="$el.classList.add('animate-[ping_0.5s_ease-in-out_1]')" class="mb-1"></x-delete-button>

                        </template>

                        {{-- Close button --}}
                        <x-non-submit-button x-on:click="open = false" class="mx-2 mb-1">Close</x-non-submit-button>
                    </div>

                </div>
               
            @endif 
                
            @if (session('readData_success') === false)
            
                <div class="mt-4 max-h-[50vh] lg:max-h-[25vh] modal_table">
                    <!-- Info icon -->
                    <div class="flex items-center mx-4 lg:mx-8">
                        <img class="mr-4" src="{{ Vite::svg('info_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg') }}"><span class="text-center mr-2">Tabulka je prázná.</span>
                    </div>
                    <!-- Close button -->
                    <div class="mt-4 flex justify-end">
                        <x-non-submit-button x-on:click="open = false" class="mx-2 mb-1">Close</x-non-submit-button>
                    </div>
                </div>

            @endif
            
        </template>
        
    </div>

</div>