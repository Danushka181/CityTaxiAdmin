<script setup>
import mapboxgl from "mapbox-gl";
mapboxgl.accessToken = 'pk.eyJ1IjoiZGFudXNoa2ExODEiLCJhIjoiY2xzcnZmMXo4MWFsczJscHNlbWM2bmFhdyJ9.vxYam2zNFqMoiduIGZvZ_g';
import {ref, onMounted, onBeforeUnmount} from "vue";
import MapboxDirections from '@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions';
import '@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions.css';

const mapContainer = ref(null);
const map = ref(null);
const latLang = ref([78.9629, 20.5937]);
const markers = ref([]);
const directions = ref(null);
const distance = ref(0.0);

const emit = defineEmits(
    ['markers', 'distance', 'time','location']
);



onMounted(() => {
    /* Create a initial map location */
    map.value = new mapboxgl.Map({
        container: mapContainer.value,
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [80.06751905855799, 7.672147625101005],
        zoom: 12
    });

    // Add directions controls to the map after initialized
    directions.value = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
        profile: 'mapbox/driving',
        interactive: false,
        controls: {
            instructions: false
        }
        });
    map.value.addControl(directions.value, 'top-right');


    // get current location.
    navigator.geolocation.getCurrentPosition(position => {
        const { latitude, longitude } = position.coords;
        map.value.setCenter({lat:latitude, lng:longitude});

        new mapboxgl.Marker()
        .setLngLat([longitude,latitude])
        .addTo(map.value);
    });

    /* Set markers on click map */
    map.value.on('click', (e) => {
        clearMarkersExceptLastTwo();
        addMarker(e.lngLat.lat, e.lngLat.lng);
        calculateRoute();
    });

});

/* Calculate directions and add to map */
function calculateRoute() {
    if ( markers.value[0] === undefined ) return;
    if ( markers.value[1] === undefined ) return;

    const startLngLat = markers.value[0].getLngLat();
    const endLngLat = markers.value[1] ? markers.value[1].getLngLat() : null;

    emit('location', {startLngLat, endLngLat});

    directions.value.setOrigin([startLngLat.lng, startLngLat.lat]);
    directions.value.setDestination([endLngLat.lng, endLngLat.lat]);

    directions.value.on('route', (e) => {
        distance.value = (e.route[0].distance / 1000).toFixed(2);
        emit('distance', distance.value);
    });

    emit('markers', markers.value);

}

/* Add Marker to the map */
function addMarker(lat, lng) {
    const marker = new mapboxgl.Marker({ draggable: true })
        .setLngLat([lng, lat])
        .addTo(map.value);
    markers.value.push(marker);

    if (markers.value.length === 1) {
        clearMarkersExceptLastTwo();
    }

    // Listen for marker drag event on the map
    marker.on('dragend', () => {
        calculateRoute();
    });
}

function clearMarkersExceptLastTwo() {
    const numMarkers = markers.value.length;
    for (let i = 0; i < numMarkers - 1; i++) {
        markers.value[i].remove();
    }
    markers.value = markers.value.slice(numMarkers - 3);
}


onBeforeUnmount(() => {
    if (map) {
        map.value.remove();
    }
});

</script>
<template>
    <div ref="mapContainer" class="map-container"></div>
</template>

<style>
.map-container {
    height: 400px;
    width: 100%;
}
#map {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 100%;
}

.mapboxgl-marker {
    //background-image: url('/images/map-marker.png');
    background-size: cover;
    border-radius: 50%;
    cursor: pointer;
}

.mapboxgl-popup {
    max-width: 200px;
}

.mapboxgl-popup-content {
    text-align: center;
    font-family: 'Open Sans', sans-serif;
}
</style>
