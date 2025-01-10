<div class="w-1/4 h-100 shadow-2xl p-8 text-xl font-medium overflow-hidden min-w-96">

    <form id="i-geo-form" class="flex flex-col">

        <div class="flex justify-between items-baseline mb-14">
            
            <x-input-whisper id="i-search-field" name="search-field"/>

            {{-- <span class="select-none mr-4">něco:</span><input id="i-search-field" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off"> --}}
            
        </div>
        
        
        <x-submit-button class="mt-4">Hledej</x-submit-button>
        
    </form>
   
</div>
