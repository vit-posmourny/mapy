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


// on click we read the coordinates (longitude, latitude) from the event and send a request to the rgeocode API function
map.on('click', async function mapClick(e) {
	let html = '';

	// Získání souřadnic kliknutí
    let lat = e.latlng.lat;
    let lon = e.latlng.lng;

	let lat_elem = document.getElementById('i-label');
	let loc_elem = document.getElementById('i-location');
	let name_elem = document.getElementById('i-name');
	let zip_elem = document.getElementById('i-zip');

	try {
		const response = await fetch(`https://api.mapy.cz/v1/rgeocode/?lon=${lon}&lat=${lat}&apikey=${API_KEY}`, {
			mode: 'cors',
		});
		const json = await response.json();

		if (json?.items?.length > 0) {
			html = '<p>Response details are available in the console.</p><ul>';
			json.items.forEach(item => {
				html += `<li>${item.label}</li>`;
				html += `<li>${item.location}</li>`;
				html += `<li>${item.name}</li>`;
				html += `<li>${item.position.lat}</li>`;
				html += `<li>${item.position.lon}</li>`;
				item.regionalStructure.forEach(index => {
					html += `<li>${index.name}</li>`;
					html += `<li>${index.type}</li>`;
					if (index.type == 'regional.country'){
						html += `<li>${index.isoCode}</li>`;
					}
				})
			});
			html += '</ul>';

			// whatever we got from the API, we log to the console
			console.log(json.items);
		} else {
			html = '<p>No results found.</p>';
		}

		// if we have the answer, we show a popup with some info
		L.popup()
			.setLatLng(e.latlng)
			.setContent(html)
			.openOn(map)
	} catch (ex) {
		// in case of any trouble, we log it to the console
		console.log(ex);
	}
});