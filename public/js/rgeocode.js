// replace with your own API key
const API_KEY = 'eyJpIjoyNTcsImMiOjE2Njc0ODU2MjN9.c_UlvdpHGTI_Jb-TNMYlDYuIkCLJaUpi911RdlwPsAY';

/*
We create a map with initial coordinates zoom, a raster tile source and a layer using that source.
See https://maplibre.org/maplibre-gl-js-docs/example/map-tiles/
See https://maplibre.org/maplibre-gl-js-docs/style-spec/sources/#raster
See https://maplibre.org/maplibre-gl-js-docs/style-spec/layers/
*/
const map = new maplibregl.Map({
	container: 'map',
	center: [14.8981184, 49.8729317],
	zoom: 15,
	style: {
		version: 8,
		sources: {
			'basic-tiles': {
				type: 'raster',
				url: `https://api.mapy.cz/v1/maptiles/basic/tiles.json?apikey=${API_KEY}`,
				tileSize: 256,
			},
		},
		layers: [{
			id: 'tiles',
			type: 'raster',
			source: 'basic-tiles',
		}],
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

// we add our LogoControl to the map
map.addControl(new LogoControl(), 'bottom-left');

// on click we read the coordinates (longitude, latitude) from the event and send a request to the rgeocode API function
map.on('click', async function mapClick(event) {
	let html = '';

	try {
		const response = await fetch(`https://api.mapy.cz/v1/rgeocode/?lon=${event.lngLat.lng}&lat=${event.lngLat.lat}&apikey=${API_KEY}`, {
			mode: 'cors',
		});
		const json = await response.json();

		if (json?.items?.length > 0) {
			html = '<p>Response details are available in the console.</p><ul>';
			json.items.forEach(item => {
				html += `<li>${item.name}</li>`;
			});
			html += '</ul>';

			// whatever we got from the API, we log to the console
			console.log(json.items);
		} else {
			html = '<p>No results found.</p>';
		}

		// if we have the answer, we show a popup with some info
		new maplibregl.Popup()
			.setLngLat(event.lngLat)
			.setHTML(html)
			.addTo(map);
	} catch (ex) {
		// in case of any trouble, we log it to the console
		console.log(ex);
	}
});