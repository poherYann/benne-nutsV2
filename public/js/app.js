$(function () {
    // Sidebar toggle behavior
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
    });
});

// JS de mapbox

mapboxgl.accessToken = 'pk.eyJ1Ijoibm9saWZlcnR1IiwiYSI6ImNrbHJyazA4NjBzMnMybmxsbnU4d3pvbGgifQ.w8XPKpamGGHXCjs5ZJmW8g';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [0.340375, 46.580224],
    zoom: 8
});
$.ajax({

    url: 'https://127.0.0.1:8000/mapbox',
    type: 'GET',

    success: function (poitier) {
        var benne = JQuery.parseJSON(poitier);
        console.log(poitier);
        map.on('load', function () {

            var geoJSON = {
                type: 'FeatureCollection',
                features: []
            };
            var i;
            for (i=0;i<benne.length;i++) {
                geoJSON.features.push({
                    type: 'Feature',
                    geometry: {
                        type : 'Point',
                        coordinates: [benne[i]['longitude'], benne[i]['latitude']]
                    },
                })
            }
            map.loadImage(
                'https://i.imgur.com/JzCmtJG.png',
                function (error, image) {
                    if (error) throw error;
                    map.addImage('custom-marker', image);

                    // Add a symbol layer
                    map.addLayer({
                        'id': 'points',
                        'type': 'symbol',
                        'source': 'points',
                        'layout': {
                            'icon-image': 'custom-marker',
                            // get the title name from the source's "title" property
                            'text-field': ['get', 'title'],
                            'text-font': [
                                'Open Sans Semibold',
                                'Arial Unicode MS Bold'
                            ],
                            'text-offset': [0, 1.25],
                            'text-anchor': 'top'
                        }
                    });
                }
            );
        })
    },
})