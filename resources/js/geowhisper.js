///////////////////////////////////////////////////// WHISPERING ///////////////////////////////////////////////////////



// replace with your own API key
const API_KEY = 'ZKBUR07BFrPvZSJKn3JnO8eL-g7FqYN9Ufcp4QHwnxo';

const form = document.getElementById('i-geo-form');
const input = document.getElementById('i-search-field');
// cache - [key: query] = suggest items
const queryCache = {};
// get items by query
const getItems = async(query) => {

    if (queryCache[query]) {
        return queryCache[query];
    }
    
    try {
        // you need to use your own api key!
        const fetchData = await fetch(`https://api.mapy.cz/v1/suggest?lang=cs&limit=5&type=regional.address&apikey=${API_KEY}&query=${query}`);
        const jsonData = await fetchData.json();
        // map values to { value, data }
        const items = jsonData.items.map(item => ({
            value: item.name,
            data: item,
        }));
        
        // save to cache
        queryCache[query] = items;
        
        return items;
    } 
    catch (exc) {
        return [];
    }
};

const autoCompleteJS = new autoComplete({
    selector: () => input,
    // placeHolder: "Zadejte hledanou adresu...",
    searchEngine: (query, record) => `<mark>${record}</mark>`,
    data: {
        keys: ["value"],
        src: async(query) => {
        // get items for current query
            const items = await getItems(query);
            
            // cache hit? - there is a problem, because this provider needs to get items
            // for each query and cannot handle different timeouts for different query.
            // if previous query was completed - it's already in the cache, and some
            // old query is completed, we test it againts current query and returns correct items.
            if (queryCache[input.value]) {
                return queryCache[input.value];
            }
            return items;
        },
        cache: false,
    },
    resultItem: {
        element: (item, data) => {
            const itemData = data.value.data;
            const desc = document.createElement("div");
        
            desc.style = "overflow: hidden; white-space: nowrap; text-overflow: ellipsis;";
            desc.innerHTML = `${itemData.label}, ${itemData.location}`;
            item.append(desc,);
        },
        highlight: true
    },
    resultsList: {
        element: (list, data) => {
            list.style.maxHeight = "max-content";
            list.style.overflow = "hidden";
    
            if (!data.results.length) {
                const message = document.createElement("div");
                
                message.setAttribute("class", "no_result");
                message.style = "padding: 5px";
                message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                list.prepend(message);
            } else {
                const logoHolder = document.createElement("div");
                const text = document.createElement("span");
                const img = new Image();
                
                logoHolder.style = "padding: 5px; display: flex; align-items: center; justify-content: end; gap: 5px; font-size: 12px;";
                text.textContent = "Powered by";
                img.src = "https://api.mapy.cz/img/api/logo-small.svg";
                img.style = "width: 60px";
                logoHolder.append(text, img);
                list.append(logoHolder);
            }
        },
        noResults: true,
    },
});


input.addEventListener("selection", event => {
    // "event.detail" carries the autoComplete.js "feedback" object
    // saved data from line 16 (mapping)
    const origData = event.detail.selection.value.data;
    // data to debug
    console.log(origData);
    input.value = origData.name;
});



/////////////////////////////////////////////////////////// GEOCODING /////////////////////////////////////////////////////



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
            'places': {
                type: 'geojson',
        data: {
            type: 'FeatureCollection',
            features: [
                {
                    type: 'Feature',
                    properties: {
                        description:
                            '<strong>Make it Mount Pleasant</strong><p><a href="http://www.mtpleasantdc.com/makeitmtpleasant" target="_blank" title="Opens in a new window">Make it Mount Pleasant</a> is a handmade and vintage market and afternoon of live entertainment and kids activities. 12:00-6:00 p.m.</p>',
                        icon: 'theatre'
                    },
                    geometry: {
                        type: 'Point',
                        coordinates: [50.07524023973632, 14.49028015136719],
                },
                
            }]
        }
            }
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
        },{
            id: 'places',
    type: 'symbol',
    source: 'places',
    layout: {
        'icon-image': '{icon}_15',
        'icon-overlap': 'always',
    },
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


map.on('load', () => {
    map.addSource('places', {
        'type': 'geojson',
        'data': {
            'type': 'FeatureCollection',
            'features': [
                {
                    'type': 'Feature',
                    'properties': {
                        'description':
                            '<strong>Make it Mount Pleasant</strong><p><a href="http://www.mtpleasantdc.com/makeitmtpleasant" target="_blank" title="Opens in a new window">Make it Mount Pleasant</a> is a handmade and vintage market and afternoon of live entertainment and kids activities. 12:00-6:00 p.m.</p>',
                        'icon': 'theatre'
                    },
                    'geometry': {
                        'type': 'Point',
                        'coordinates': [14.49028015136719, 50.07524023973632],
                    }
                },
                
            ]
        }
    })
});


// Add a layer showing the places.
map.addLayer({
    'id': 'places',
    'type': 'symbol',
    'source': 'places',
    'layout': {
        'icon-image': '{icon}_15',
        'icon-overlap': 'always'
    }
});


// When a click event occurs on a feature in the places layer, open a popup at the
// location of the feature, with description HTML from its properties.
map.on('click', 'places', (e) => {
    const coordinates = e.features[0].geometry.coordinates.slice();
    const description = e.features[0].properties.description;

    // Ensure that if the map is zoomed out such that multiple
    // copies of the feature are visible, the popup appears
    // over the copy being pointed to.
    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    new maplibregl.Popup()
        .setLngLat(coordinates)
        .setHTML(description)
        .addTo(map);
});


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