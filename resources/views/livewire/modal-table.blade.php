{{-- livewire\modal-table.blade.php --}}
<div x-cloak x-show="open" x-on:click="open = false" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-gray-400 bg-opacity-50" x-transition>
    {{-- @click.stop="" on the modal content: This is crucial. It prevents the click event from bubbling up to the overlay, so clicks inside the modal don't close it. --}}
    <div class="bg-white max-w-2xl lg:max-w-fit rounded-lg shadow-lg p-2" @click.stop="" @keydown.escape.window="open = false">
        <!-- Modal Header -->
        <div class="flex justify-between px-3 pt-1 h-6">

            <h2 class="text-xl font-bold select-none">Uložená místa</h2>
            <button x-on:click="open = false" class="text-lg text-gray-600 hover:text-gray-900">X</button>

        </div>

        <template x-if="open">
            <!-- Modal Table -->
            <div class="mt-4 max-h-[50vh] lg:max-h-[25vh] overflow-auto scroll-smooth modal_table">

                <table class="text-base border-collapse border border-slate-400">

                    <thead class="font-bold text-lg text-green-900 bg-green-200">
                        <tr>
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
                        <tr>
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
        </template>
        <!-- Modal Buttons -->
        <div class="mt-4 flex justify-end">
            
            <x-non-submit-button x-on:click="open = false" class="mr-2 mb-1">Close</x-non-submit-button>
            
        </div>
    </div>
</div>

