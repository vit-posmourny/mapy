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
const map = new maplibregl.Map({
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
					features: [],
				},
				generateId: true,
			},
		},
		layers: [
    	{
        id: 'tiles',
        type: 'raster',
        source: 'basic-tiles',
      },
      {
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
      },
    ],
	},
});

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

async function geocode(query) {
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

    console.log('geocode', json);
    
    const source = map.getSource('markers');
    
    if (source) {
    	source.setData({
        type: 'FeatureCollection',
        features: json.items.map(item => ({
					type: 'Feature',
					geometry: {
						type: 'Point',
						coordinates: [item.position.lon, item.position.lat],
					},
					properties: {
						name: item.name,
            label: item.label,
            location: item.location,
						longitude: item.position.lon,
						latitude: item.position.lat,
					},
				})),
      });
    }
    
    // finally we set the map to show the whole geometry in the viewport
    map.jumpTo(
    	map.cameraForBounds(
      	bbox(json.items.map(item => ([item.position.lon, item.position.lat]))),
        {
          padding: 40,
        }
      )
    );
  } catch (ex) {
  	console.log(ex);
  }
}


form.addEventListener('submit', function(event) {
	event.preventDefault();
  geocode(input.value);
}, false);


map.on('load', function () {
	map.loadImage(
		'https://api.mapy.cz/img/api/marker/drop-red.png',
		function (error, image) {
			if (error) throw error;
			map.addImage('marker-icon', image);
    }
  );
});