<script setup>
import mapboxgl from 'mapbox-gl';
import MainContent from "@/Layouts/MainContent.vue";
import {Head, useForm} from "@inertiajs/vue3";
import Sidebar from "@/Layouts/Sidebar.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";

import MapBox from "@/Components/MapBox.vue";
import 'mapbox-gl/dist/mapbox-gl.css';

const props = defineProps({
    drivers: Array
});

const form = useForm({
    driver_id: null,
    trip_distance: 0,
    amount: 0,
    pickup_location: '',
    drop_location: '',
    fair: 0.0
});


const markers = ref([]);
const direction = ref(0.0);
const tripFair = ref(0.0);

/* Handle markers */
const handleMarkers = (data) => {
    markers.value = data;
}

/* get Distance from child */
const handleDistance = (data) => {
    direction.value = data;
    form.trip_distance = direction;
    calculateFair(form.driver_id);
}

/* Calculate fair */
const calculateFair = (driverId) => {
    if (driverId === 'null' || driverId === '') return;
    form.driver_id = driverId;

    const selectedDriver = props.drivers.find(driver => driver.id === driverId);
    if (!selectedDriver) {
        return;
    }

    const driverRate = parseFloat(selectedDriver.driver.hire_rate);
    const directionValue = parseFloat(direction.value);

    form.trip_distance = directionValue;

    if (isNaN(driverRate) || isNaN(directionValue)) {
        return;
    }
    const tripFairValue = directionValue * driverRate;
    const roundedTripFair = parseFloat(tripFairValue.toFixed(2));

    tripFair.value = roundedTripFair;
    form.amount = tripFair.value;

    return roundedTripFair;
}
const handleLocation = (data) => {
    form.pickup_location = `${data.startLngLat.lat}, ${data.startLngLat.lng}`;
    form.drop_location = `${data.endLngLat.lat}, ${data.endLngLat.lng}`;
}


</script>


<template>
    <Head title="Drivers" />

    <AuthenticatedLayout>
        <div class="content-wrapper">
            <Sidebar />
            <MainContent>
                <div class="drivers max-w-7xl mx-auto sm:px-6 lg:px-8 m-5">
                    <div class="drivers-list">
                        <div class="">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-3 px-4">
                                <div class="text-gray-900 text-2xl">Create a Trip : </div>
                            </div>
                        </div>
                    </div>
                    <div class="drivers-list-table mt-5 p-4 bg-white">
                        <MapBox  @markers="handleMarkers" @distance="handleDistance" @location="handleLocation" />
                        <div class="matrics mt-3">
                            <p class="mb-3">Click on the map to set start and end locations (You can drag markers)</p>
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <label class="block text-gray-700 font-bold mb-2 text-xl font-bold">
                                            Distance
                                        </label>
                                        <p class="text-gray-900 text-sm font-bold">{{direction}} KM</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <label class="block text-gray-700 font-bold mb-2 text-xl font-bold">
                                            Fair
                                        </label>
                                        <p class="text-gray-900 text-sm font-bold">{{ tripFair }} RS</p>
                                    </div>
                                </div>
                            </div>
                            <form class="mt-4" v-if="direction">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="is_banned" class="form-label">Available Drivers</label>
                                        <select name="driver" class="form-select" id="driver" v-model="form.driver_id" @change="calculateFair(form.driver_id)">
                                            <option value="null">Select Driver</option>
                                            <option v-for="driver in props.drivers" :value="driver.id">{{driver.driver.name}} - Rate {{driver.driver.hire_rate}} (per KM)</option>
                                        </select>
                                        <div v-if="form.errors.driver_id" class="form-text text-red-600">{{ form.errors.driver_id }}</div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="trip_distance" class="form-label">Distance (KM)</label>
                                        <input type="text" class="form-control" id="trip_distance" v-model="form.trip_distance" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="amount" class="form-label">Trip Fair (RS)</label>
                                        <input type="text" class="form-control" id="amount" v-model="form.amount" readonly>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="trip_date" class="form-label">Trip Time <span class="text-red-600">*</span> </label>
                                        <div class="flex gap-3 flex-row">
                                            <select id="hourSelect">
                                                <!-- Hours -->
                                                <optgroup label="Hours">
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                </optgroup>
                                            </select>

                                            <select id="minuteSelect">
                                                <!-- Minutes -->
                                                <optgroup label="Minutes">
                                                    <option value="00">00</option>
                                                    <option value="05">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="pickup_location" class="form-label">Pickup Location (lat, lang)</label>
                                        <input type="text" class="form-control" id="pickup_location" v-model="form.pickup_location" readonly>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="drop_location" class="form-label">Drop Location (lat, lang)</label>
                                        <input type="text" class="form-control" id="drop_location" v-model="form.drop_location" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-xl my-4">Passenger Details:</h3>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="name" class="form-label">Name <span class="text-red-600">*</span> </label>
                                        <input type="text" class="form-control" id="name" v-model="form.name">
                                        <div v-if="form.errors.name" class="form-text text-red-600">{{ form.errors.name }}</div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="email" class="form-label">Email <span class="text-red-600">*</span> </label>
                                        <input type="email" class="form-control" id="email" v-model="form.email">
                                        <div v-if="form.errors.email" class="form-text text-red-600">{{ form.errors.email }}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="phone" class="form-label">Phone <span class="text-red-600">*</span> </label>
                                        <input type="text" class="form-control" id="phone" v-model="form.phone">
                                        <div v-if="form.errors.phone" class="form-text text-red-600">{{ form.errors.phone }}</div>
                                    </div>
                                    <div class="mb-3 col-8">
                                        <label for="address" class="form-label">Address </label>
                                        <input type="text" class="form-control" id="address" v-model="form.address">
                                        <div v-if="form.errors.address" class="form-text text-red-600">{{ form.errors.address }}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 flex gap-3 flex-row align-items-center">
                                        <input type="checkbox" name="privacy" id="privacy" v-model="form.privacy">
                                        <label for="privacy" class="form-label p-0 lh-0 m-0">I request to hide my details from the driver</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="payment">Payment Method</label>
                                        <select name="payment" id="payment" class="form-select" v-model="form.payment">
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary bg-black border-none">Create Trip</button>
                                    </div>
                                </div>
                            </form>
                            <div v-else class="mt-3">
                                <p class="alert alert-info">Please set pickup and Drop Locations before create a Trip</p>
                            </div>
                        </div>
                    </div>
                </div>
            </MainContent>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
