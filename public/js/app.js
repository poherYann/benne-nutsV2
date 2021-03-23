jQuery(document).ready(function ($) {
    $(function () {
        // Sidebar toggle behavior
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
        });
    });

// JS de mapbox
    $.ajax({
        url: '/mapbox/ajax',
        type: 'POST',
        dataType: 'json',
        async: true,

        success: function (data, status) {

            console.log(data);
            console.log(status)

            // for (let i=0; i<data.length)
            console.log(Object.keys(data).length);
            console.log(data[0].latitude);

            map.on('load', function () {
                var geojson = {
                    type: 'featureCollection',
                    features: []
                };

                for (var i = 0; i < Object.keys(data).length; i++) {
                    geojson.features.push({
                        type: 'Feature',
                        geometry: {
                            type: 'Point',
                            coordinates: [data[i].longitude, data[i].latitude]
                        },
                        properties: {
                            title: 'Benne à verre'
                        }
                    });
                }

                geojson.features.forEach(function (marker) {
                    var el = document.createElement('div');
                    el.className = 'marker';
                    new mapboxgl.Marker(el)
                        .setLngLat(marker.geometry.coordinates)
                        .addTo(map)
                        .setPopup(new mapboxgl.Popup({offset: 25})
                            .setHTML('<h3>' + marker.properties.title + '</h3>'))
                        .addTo(map);
                });
            });
        }, error: function (xhr, textStatus, errorThrown) {
            console.log('request failed');
        }
    });
    mapboxgl.accessToken = 'pk.eyJ1Ijoibm9saWZlcnR1IiwiYSI6ImNrbHJyazA4NjBzMnMybmxsbnU4d3pvbGgifQ.w8XPKpamGGHXCjs5ZJmW8g';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: [0.340375, 46.580224],
        zoom: 8
    });
});

