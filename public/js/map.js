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


// Přidání události 'click' na mapu (Zjištění výšky)
map.on('click', function(e) {
  // Získání souřadnic kliknutí
  let lat = e.latlng.lat;
  let lon = e.latlng.lng;

  var latitude_elem = document.getElementById('latitude');
  var longitude_elem = document.getElementById('longitude');
  var elevation_elem = document.getElementById('elevation');

  latitude_elem.value = lat;
  longitude_elem.value = lon;


  // Volání API pro získání výšky
  fetch(`https://api.mapy.cz/v1/elevation?lang=cs&positions=${lon}%2C${lat}&apikey=${API_KEY}`)
      .then(response => response.json())
      .then(data => {
          // Získání výšky z odpovědi API
          let elevation = data.items[0].elevation;
          elevation_elem.value = elevation;
          
          // Vytvoření popup okna s výškou
          L.popup()
              .setLatLng(e.latlng)
              .setContent(`Výška: ${elevation} metrů`)
              .openOn(map);
      })
      .catch(error => console.error('Chyba při volání API: ', error));
});