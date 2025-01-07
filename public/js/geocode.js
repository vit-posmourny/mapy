// replace with your own API key
const API_KEY = 'ZKBUR07BFrPvZSJKn3JnO8eL-g7FqYN9Ufcp4QHwnxo';

const form = document.getElementById('i-geo-form');
const input = document.getElementById('i-search-field');
/*
We create a map with initial coordinates zoom, a raster tile source and a layer using that source.
See https://maplibre.org/maplibre-gl-js-docs/example/map-tiles/
See https://maplibre.org/maplibre-gl-js-docs/style-spec/sources/#raster
See https://maplibre.org/maplibre-gl-js-docs/style-spec/layers/
*/
const map = new maplibregl.Map(
{
    container: 'map',
    center: [14.49028015136719, 50.07524023973632],
    zoom: 12,
    style: {
        version: 8,
        sources: {
            'basic-tiles': {
              type: 'raster',
              url: `https://api.mapy.cz/v1/maptiles/basic/tiles.json?apikey=${API_KEY}`,
              tileSize: 256,
            },
            'markers': {
              type: 'geojson',
              data: {
                type: 'FeatureCollection',
                features: []
              },
              generateId: true,
            },
        },
        layers: [{
            id: 'tiles',
            type: 'raster',
            source: 'basic-tiles',
        },{
            id: 'markers',
            type: 'symbol',
            source: 'markers',
            layout: {
                'icon-image': 'marker-icon',
                'icon-size': window.devicePixelRatio > 1 ? 0.5 : 1,
                'icon-allow-overlap': true,
            },
            paint: {},
            filter: ['==', '$type', 'Point'],
        }],
    },
  })
   /*
  We also require you to include our logo somewhere over the map.
  We create our own map control implementing a documented interface,
  that shows a clickable logo.
  See https://maplibre.org/maplibre-gl-js-docs/api/markers/#icontrol
  */
  class LogoControl {
    onAdd(map) {
      this._map = map;
      this._container = document.createElement('div');
      this._container.className = 'maplibregl-ctrl';
      this._container.innerHTML = '<a href="http://mapy.cz/" target="_blank"><img  width="100px" src="https://api.mapy.cz/img/api/logo.svg" ></a>';

      return this._container;
    }
  
    onRemove() {
      this._container.parentNode.removeChild(this._container);
      this._map = undefined;
    }
}

// finally we add our LogoControl to the map
map.addControl(new LogoControl(), 'bottom-left');


form.addEventListener('submit', function(event) {
  event.preventDefault();
  geocode(input.value);
}, false);


// function for calculating a bbox from an array of coordinates
function bbox(coords) {

    let minLatitude = Infinity;
    let minLongitude = Infinity;
    let maxLatitude = -Infinity;
    let maxLongitude = -Infinity;

    coords.forEach(coor => {
        minLongitude = Math.min(coor[0], minLongitude);
        maxLongitude = Math.max(coor[0], maxLongitude);
        minLatitude = Math.min(coor[1], minLatitude);
        maxLatitude = Math.max(coor[1], maxLatitude);
    });
    return [
        [minLongitude, minLatitude],
        [maxLongitude, maxLatitude],
    ];
}


const markerElement = document.createElement('div');
markerElement.className = 'marker';
markerElement.style.width = '20px';
markerElement.style.height = '20px';


async function geocode(query) 
{
    try {
        const url = new URL(`https://api.mapy.cz/v1/geocode`);

        url.searchParams.set('lang', 'cs');
        url.searchParams.set('apikey', API_KEY);
        url.searchParams.set('query', query);
        url.searchParams.set('limit', '15');
        [
          'regional.municipality',
          'regional.municipality_part',
          'regional.street',
          'regional.address',
          'coordinate',
        ].forEach(type => url.searchParams.append('type', type));

        const response = await fetch(url.toString(), {
          mode: 'cors',
        });
        const json = await response.json();

        // přidává markery do mapy
        json.items.forEach(item => {
            new maplibregl.Marker(markerElement)
                .setLngLat([item.position.lon, item.position.lat])
                .addTo(map);
        });
        
        // jestliže bude marker/hit pouze jeden nastaví správně boundingbox
        var coordArr = [];

        if (json.items.length == 1)
        {
            coordArr = json.items[0].bbox;            
        }else {
            coordArr = bbox(json.items.map(item => ([item.position.lon, item.position.lat])))
        }
        
        // finally we set the map to show the whole geometry in the viewport
        map.jumpTo(
            map.cameraForBounds(
                coordArr,
                {
                  padding: 40,
                }
            )
        );
    } 
    catch (ex) {
      console.log(ex);
    }
}