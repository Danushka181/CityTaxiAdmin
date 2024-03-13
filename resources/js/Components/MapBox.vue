<script setup>
import mapboxgl from "mapbox-gl";
mapboxgl.accessToken = 'pk.eyJ1IjoiZGFudXNoa2ExODEiLCJhIjoiY2xzcnZmMXo4MWFsczJscHNlbWM2bmFhdyJ9.vxYam2zNFqMoiduIGZvZ_g';
import {ref, onMounted, onBeforeUnmount} from "vue";

const mapContainer = ref(null);
const map = ref(null);
const latLang = ref([78.9629, 20.5937]);

onMounted(() => {

    map.value = new mapboxgl.Map({
        container: mapContainer.value,
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [78.9629, 20.5937],
        zoom: 12
    });

    // get current location.
    navigator.geolocation.getCurrentPosition(position => {
        const { latitude, longitude } = position.coords;
        map.value.setCenter([longitude, latitude]);
    });

    new mapboxgl.Marker()
        .setLngLat([78.9629, 20.5937]) // Set the coordinates of the marker
        .addTo(map.value);


});

onBeforeUnmount(() => {
    if (map) {
        map.value.remove();
    }
});

</script>
<template>
    <div ref="mapContainer" class="map-container"></div>
</template>

<style scoped>
.map-container {
    height: 400px;
    width: 100%;
}
</style>
