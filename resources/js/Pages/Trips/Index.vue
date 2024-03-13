<script setup>

import MainContent from "@/Layouts/MainContent.vue";
import {Head} from "@inertiajs/vue3";
import Sidebar from "@/Layouts/Sidebar.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    allTrips: Array,
    allPendingTrips: Array,
    allCompletedTrips: Array,
    allCancelledTrips: Array,
});

const deleteTrip = () => {
    console.log('delete trip');
}

</script>


<template>
    <Head title="Trips" />

    <AuthenticatedLayout>
        <div class="content-wrapper">
            <Sidebar />
            <MainContent>
                <div class="drivers max-w-7xl mx-auto sm:px-6 lg:px-8 m-5">
                    <div class="drivers-list">
                        <div class="">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-3 px-5">
                                <div class="text-gray-900 text-2xl">Trips List</div>
                                <p>Manage Trips in the system</p>
                            </div>
                        </div>
                    </div>
                    <div class="drivers-list mt-3">
                        <div class="row m-0">
                            <div class="col bg-black p-3 text-white">
                                <h3 class="text-xl text-white">Total Trips</h3>
                                <p>{{ allTrips.length }}</p>
                            </div>
                            <div class="col bg-black p-3 text-white">
                                <h3 class="text-xl text-white">Ongoing Trips</h3>
                                <p>{{ allPendingTrips.length }}</p>
                            </div>
                            <div class="col bg-black p-3 text-white">
                                <h3 class="text-xl text-white">Completed Trips</h3>
                                <p>{{ allCompletedTrips.length }}</p>
                            </div>
                        </div>
                    </div>
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0 text-green-600"
                        @after-enter="startTimer">
                        <div v-if="showMsg" class="drivers-list-table mt-4 p-2 bg-white">
                            <p  class="text-sm text-green-600">{{$page.props.flash.success}}</p>
                        </div>
                    </Transition>
                    <div class="drivers-list-table mt-5 p-4 bg-white">
                        <div class="flex justify-end">
                            <a :href="route('trips.create')" class="btn btn-primary bg-black border-none">Create Trip</a>
                        </div>
                        <table class="table mt-6">
                            <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Passenger</th>
                                <th scope="col">Status</th>
                                <th scope="col">Distance</th>
                                <th scope="col">Price</th>
                                <th scope="col" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="p-2">
                            <tr v-for="trip in allTrips" :key="trip.id">
                                <th scope="row">{{ trip.id }}</th>
                                <td>{{ trip.driver.name }}</td>
                                <td>{{ trip.passenger.name }}</td>
                                <td>{{ trip.status }}</td>
                                <td>{{ trip.trip_distance }} KM</td>
                                <td>{{ trip.id }}</td>
                                <td class="text-right">
                                    <a :href="route('trips.show',trip.id)" class="btn btn-link">View</a>
                                    <a href="#" @click="deleteTrip(trip.id)" class="btn btn-link text-red-600">Delete</a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </MainContent>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
