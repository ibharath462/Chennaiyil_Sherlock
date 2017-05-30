mapboxgl.accessToken = 'pk.eyJ1IjoidmlzaW9udHJpYWwiLCJhIjoiY2l6MmFpYWR5MDR1bzJxcWY4ajQ3a2MxMSJ9.hEJxPTsFHsB4jrLjFlYomQ';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/visiontrial/ciz2hmiqo002d2rqbejvn7a3l',
        center: [80.239,13.015],
        zoom: 18,
        bearing: -12,
        pitch: 60,
        interactive: false
    });

    // pixels the map pans when the up or down arrow is clicked
    var deltaDistance = 100;

    // degrees the map rotates when the left or right arrow is clicked
    var deltaDegrees = 50;

    function easing(t) {
        return t * (2 - t);
    }

    map.on('load', function() {
        map.getCanvas().focus();

        map.getCanvas().addEventListener('keydown', function(e) {
            e.preventDefault();
            if (e.which === 38) { // up
                map.panBy([0, -deltaDistance], {
                    easing: easing
                });
            } else if (e.which === 40) { // down
                map.panBy([0, deltaDistance], {
                    easing: easing
                });
            } else if (e.which === 37) { // left
                map.easeTo({
                    bearing: map.getBearing() - deltaDegrees,
                    easing: easing
                });
            } else if (e.which === 39) { // right
                map.easeTo({
                    bearing: map.getBearing() + deltaDegrees,
                    easing: easing
                });
            }
        }, true);
    });

    map.on('load', function () {

     
  });


// When a click event occurs near a place, open a popup at the location of
// the feature, with description HTML from its properties.
map.on('click', function (e) {
    var features = map.queryRenderedFeatures(e.point, { layers: ['cs'] });

    if (!features.length) {
        return;
    }

    var feature = features[0];

    // Populate the popup and set its coordinates
    // based on the feature found.
    var popup = new mapboxgl.Popup()
        .setLngLat(feature.geometry.coordinates)
        .setHTML(feature.properties.description)
        .addTo(map);





});

map.on('mousemove', function (e) {
    var features = map.queryRenderedFeatures(e.point, { layers: ['cs'] });
    map.getCanvas().style.cursor = (features.length) ? 'pointer' : '';
});

function guindy(){

  var start = [80.213,13.008];

   map.flyTo({
        
        center: start,
        zoom: 18,
        bearing: -12,
        speed: 1,
        curve: 1, 
        easing: function (t) {
            return t;
        }
    });

}

function perambur(){

  var start = [80.249,13.108];

   map.flyTo({
        
        center: start,
        zoom: 18,
        bearing: -12,
        speed: 1,
        curve: 1, 
        easing: function (t) {
            return t;
        }
    });

}

function villivakam(){

  var start = [80.214,13.108];

   map.flyTo({
        
        center: start,
        zoom: 18,
        bearing: -12,
        speed: 1,
        curve: 1, 
        easing: function (t) {
            return t;
        }
    });

}

function marina(){

  var start = [80.285,13.054];

   map.flyTo({
        
        center: start,
        zoom: 18,
        bearing: -12,
        speed: 7,
        curve: 1, 
        easing: function (t) {
            return t;
        }
    });

}
