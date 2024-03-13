<script setup>
import mapboxgl from 'mapbox-gl';
import MainContent from "@/Layouts/MainContent.vue";
import {Head} from "@inertiajs/vue3";
import Sidebar from "@/Layouts/Sidebar.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";

import MapBox from "@/Components/MapBox.vue";
import 'mapbox-gl/dist/mapbox-gl.css';



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
                        <MapBox />
                    </div>
                </div>
            </MainContent>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
