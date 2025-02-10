{{-- livewire\modal-table.blade.php --}}
<div x-cloak x-show="open" x-on:click="open = false" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-gray-400 bg-opacity-50" x-transition>
    {{-- @click.stop="" on the modal content: This is crucial. It prevents the click event from bubbling up to the overlay, so clicks inside the modal don't close it. --}}
    <div class=" portrait:w-screen bg-white max-w-2xl lg:max-w-fit rounded-lg shadow-lg p-2" @click.stop="" @keydown.escape.window="open = false">
        <!-- Modal Header -->
        <div class="flex justify-between px-3 pt-1 h-6">

            <h2 class="text-xl font-bold select-none">Uložená místa</h2>
            <button x-on:click="open = false" class="text-lg ml-3 text-gray-600 hover:text-gray-900">X</button>

        </div>

        <template x-if="open">

            @if (session('readData_success') === true)
    |       
                <div class="mt-4">

                    <div class="max-h-[50vh] lg:max-h-[25vh] overflow-y-auto modal_table">
                        <!-- Table -->
                        <table class="text-base border-collapse border border-slate-400 w-auto">

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
                                    <tr x-on:click="$store.Row.pushRowId({{ $row['id'] }})" :class="$store.Row.findRowId({{$row['id']}}) ? 'bg-green-100': ''">
                                        <td class="border text-center px-2 border-slate-400">{{ $row['id'] }}</td>
                                        <td class="border text-center px-2 border-slate-400">{{ $row['label'] }}</td>
                                        <td class="border text-center px-2 border-slate-400">{{ $row['location'] }}</td>
                                        <td class="border text-center px-2 border-slate-400">{{ $row['name'] }}</td>
                                        <td class="border text-center px-2 border-slate-400">{{ $row['zip'] }}</td>
                                        <td class="border text-center px-2 border-slate-400">{{ $row['isoCode'] }}</td>
                                        <td class="border text-center px-2 border-slate-400">{{ $row['latitude'] }}</td>
                                        <td class="border text-center px-2 border-slate-400">{{ $row['longitude'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    
                        </table>

                    </div>
                    <!-- Modal Buttons -->
                    <div class="flex mt-4 justify-end">
                        {{-- Delete button --}}
                        <x-delete-button x-bind:disabled="$store.Row.rowId === null" wire:click="delete($store.Row.rowId)" class="mb-1"></x-delete-button>
                        {{-- Close button --}}
                        <x-non-submit-button x-on:click="open = false" class="mx-2 mb-1">Close</x-non-submit-button>
                        
                    </div>

                </div>  

            @endif 
                
             
            @if (session('readData_success') === false)
            
                <!-- Modal Table -->
                <div class="mt-4 max-h-[50vh] lg:max-h-[25vh] modal_table">
                    <div class="flex items-center mx-4 lg:mx-8">

                        <img class="mr-4" src="images\svg\info_24dp_F7FEE7_FILL0_wght400_GRAD0_opsz24.svg"><span class="text-center mr-2">Tabulka je prázná.</span>

                    </div>
                    <!-- Modal Button -->
                    <div class="mt-4 flex justify-end">

                        <x-non-submit-button x-on:click="open = false" class="mx-2 mb-1">Close</x-non-submit-button>
                    
                    </div>
                </div>

            @endif
            
        </template>
        
    </div>

</div>


<script>

    // document.addEventListener('keydown', function(event) 
    // {
    //     var string;
    //     if (event.altKey) 
    //     {
    //         Alpine.store('Row').rowId.forEach(value => {
    //             string += ' ' + value;
    //         });
    //          alert(string);
    //     }   
    // })

    document.addEventListener('alpine:init', () => 
    {
        Alpine.store('Row', {
            rowId: [],

            pushRowId(id) {
                if (n = this.rowId.indexOf(id) + 1) 
                {
                    this.rowId[n-1] = null;
                } 
                else {
                    this.rowId.push(id);
                }
                
            },

            findRowId(id) {
                if (this.rowId.includes(id)) 
                {
                    return true;
                } 
                else {
                    return false;
                }
            },

            purgeRowId() {
                this.rowId.length = 0;
            }
        })
    })

    document.addEventListener('deleteOk', () => 
    {
        Alpine.store('Row').purgeRowId();
    })

</script>


