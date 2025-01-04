<x-app-layout>

    <div id="map" class="w-3/4 h-[70vh] cursor-default z-0"></div>

    @if (request()->path() == 'elevation')

        <script src="js/elevation.js"></script>

    @elseif (request()->path() == 'rgeocode')

        <script src="js/rgeocode.js"></script> 

    @endif
    
</x-app-layout>