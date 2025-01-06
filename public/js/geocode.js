// replace with your own API key
const API_KEY = 'ZKBUR07BFrPvZSJKn3JnO8eL-g7FqYN9Ufcp4QHwnxo';

/*
We create the map and set its initial coordinates and zoom.
See https://leafletjs.com/reference.html#map
*/
const map = L.map('map').setView([50.0843453, 14.4792458], 12);
/*
Then we add a raster tile layer with REST API Mapy.cz tiles
See https://leafletjs.com/reference.html#tilelayer
*/
L.tileLayer(`https://api.mapy.cz/v1/maptiles/basic/256/{z}/{x}/{y}?apikey=${API_KEY}`, {
    minZoom: 0,
    maxZoom: 19,
    attribution: '<a href="https://api.mapy.cz/copyright" target="_blank">&copy; Seznam.cz a.s. a další</a>',
}).addTo(map);

/*
We also require you to include our logo somewhere over the map.
We create our own map control implementing a documented interface,
that shows a clickable logo.
See https://leafletjs.com/reference.html#control
*/
const LogoControl = L.Control.extend({
    options: {
        position: 'bottomleft',
    },

    onAdd: function (map) {
        const container = L.DomUtil.create('div');
        const link = L.DomUtil.create('a', '', container);

        link.setAttribute('href', 'http://mapy.cz/');
        link.setAttribute('target', '_blank');
        link.innerHTML = '<img src="https://api.mapy.cz/img/api/logo.svg" />';
        L.DomEvent.disableClickPropagation(link);

        return container;
    },
});

// finally we add our LogoControl to the map
new LogoControl().addTo(map);

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

const form = document.querySelector('#geocode-form');
const input = document.querySelector('#geocode-input');

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