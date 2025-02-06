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

	let lab_elem = document.getElementById('i-label');
	let loc_elem = document.getElementById('i-location');
	let name_elem = document.getElementById('i-name');
	let zip_elem = document.getElementById('i-zip');

	lab_elem.value = '';
	loc_elem.value = '';
	name_elem.value = '';
	zip_elem.value = '';
	let lat_elem = null;
	let lon_elem = null;
	let regional_address = '';
    let regional_street = ''; 
    let regional_municipality_part_1 = '';
    let regional_municipality_part_2 = '';
    let regional_municipality = '';
    let regional_region_1 = '';
    let regional_region_2 = '';
    let regional_country = '';
    let isoCode = '';

	try {
		const response = await fetch(`https://api.mapy.cz/v1/rgeocode/?lon=${lon}&lat=${lat}&apikey=${API_KEY}`, {
			mode: 'cors',
		});
		const json = await response.json();

		if (json?.items?.length > 0) {

			json.items.forEach(item => {
				// položky v rgeocode-panelu
				lab_elem.value = item.label;
				loc_elem.value = item.location;
				name_elem.value = item.name;
				zip_elem.value = item.zip ?? 'n/a';
				
				lat_elem = item.position.lat;
				lon_elem = item.position.lon;

				let a = 1;
				let b = 1;

				item.regionalStructure.forEach(index => {

					if (index.type == 'regional.address') {
						regional_address = index.name;
					}
					else if (index.type == 'regional.street') {
						regional_street = index.name;
					} 
					else if (index.type == 'regional.municipality_part') {
						if (a == 1) {
							regional_municipality_part_1 = index.name;
							a++;
						} else if (a == 2) {
							regional_municipality_part_2 = index.name;
						}
					} 
					else if (index.type == 'regional.municipality') {
						regional_municipality = index.name;
					}
					else if (index.type == 'regional.region') {	
						if (b == 1) {
							regional_region_1 = index.name;
							b++;
						} else if (b == 2) {
							regional_region_2 = index.name;
						}
					}
					else if (index.type == 'regional.country') {
						regional_country = index.name;
					}
					else (index.isoCode) 
						isoCode = index.isoCode;
				})
			})
			window.dispatchEvent(new CustomEvent('values-updated', {
				detail: {
					label: lab_elem.value,
					location: loc_elem.value,
					name: name_elem.value,
					zip: zip_elem.value,
					lat: lat_elem,
					lon: lon_elem,
					regional_address: regional_address,
					regional_street: regional_street,
					regional_municipality_part_1: regional_municipality_part_1,
					regional_municipality_part_2: regional_municipality_part_2,
					regional_municipality: regional_municipality,
					regional_region_1: regional_region_1,
					regional_region_2: regional_region_2,
					regional_country: regional_country,
					isoCode: isoCode,
				}
			}));
		}
	} catch (ex) {
		// in case of any trouble, we log it to the console
		console.log(ex);
	}
});