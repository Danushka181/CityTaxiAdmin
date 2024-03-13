<script setup>

import MainContent from "@/Layouts/MainContent.vue";
import {Head} from "@inertiajs/vue3";
import Sidebar from "@/Layouts/Sidebar.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    trip: Object,
});
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
                                <div class="text-gray-900 text-2xl">Trip : #{{trip.id}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="drivers-list-table mt-5 p-4 bg-white">

                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <h2 class="text-xl mb-2">Driver</h2>
                                <hr>
                                <div class="mb-3 mt-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Name:
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.driver.name}}</p>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Email:
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.driver.email}}</p>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Phone:
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.driver.phone}}</p>
                                </div>
                            </div>
                            <div class="w-1/2">
                                <h2 class="text-xl mb-2">Passenger</h2>
                                <hr>
                                <div class="mb-3 mt-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Name :
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.passenger.name}}</p>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Email :
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.passenger.email}}</p>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Phone :
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.passenger.phone}}</p>
                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="mt-4 row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Vehicle
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Start Date
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.start_date}}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Distance
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.trip_distance}} KM</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Trip Date
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.created_at}}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Start Location
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.start_location}}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-gray-700 text-bold mb-2 text-sm font-bold">
                                        End Location
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.end_location}}</p>
                                </div>
                            </div>
                            <div class="col-4">

                                <div class="mb-3">
                                    <label class="block text-gray-700 font-bold mb-2 text-sm font-bold">
                                        Duration
                                    </label>
                                    <p class="text-gray-900 text-sm font-bold">{{trip.trip_time}} H</p>
                                </div>
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
