<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage, } from '@inertiajs/vue3';
import Sidebar from "@/Layouts/Sidebar.vue";
import MainContent from "@/Layouts/MainContent.vue";
import {ref} from "vue";

defineProps({
    vehicle: Object
})

const showMsg = ref(false);

const deleteVehicle = (id) => {
    if (confirm('Are you sure you want to delete this vehicle?')) {
        router.delete(`vehicle/${id}`);
        showMsg.value = true;
    }
}

function startTimer() {
    // Hide the success message after 5 seconds (5000 milliseconds)
    setTimeout(() => {
        // Set the flash success message to null to hide it
        showMsg.value = false;
    }, 4000);
}

</script>

<template>
    <Head title="Vehicles" />

    <AuthenticatedLayout>
        <div class="content-wrapper">
            <Sidebar />
            <MainContent>
                <div class="drivers max-w-7xl mx-auto sm:px-6 lg:px-8 m-5">
                    <div class="drivers-list">
                        <div class="">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-3 px-5">
                                <div class="text-gray-900 text-2xl">Vehicle Details : {{vehicle.name}} </div>
                                <p>View all the details of vehicle</p>
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
                        <div class="bg-gray-100 py-8">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <img class="h-12 w-12 rounded-full" :src="vehicle.car_type.image" :alt="vehicle.car_type.name">
                                            </div>
                                            <div class="ml-4">
                                                <h2 class="text-lg font-semibold text-gray-800">{{ vehicle.name }}</h2>
                                                <p class="text-sm text-gray-500">{{ vehicle.number }}</p>
                                                <p class="text-sm text-gray-500">Car Type: {{ vehicle.car_type.name }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <h3 class="text-lg font-semibold text-gray-800">Driver Details</h3>
                                            <p class="text-sm text-gray-500">Name: {{ vehicle.driver.name }}</p>
                                            <p class="text-sm text-gray-500">Email: {{ vehicle.driver.email }}</p>
                                            <p class="text-sm text-gray-500">Phone: {{ vehicle.driver.phone }}</p>
                                            <p class="text-sm text-gray-500">License Number: {{ vehicle.driver.license_number }}</p>
                                            <p class="text-sm text-gray-500">Hire Rate: ${{ vehicle.driver.hire_rate }}</p>
                                        </div>
                                    </div>
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
.content-wrapper{
    display: grid;
    grid-template-columns: 300px 1fr;
    max-width: 1300px;
    margin: 0 auto;
}
h3{
    margin-bottom: 20px;
}
.text-sm{
    margin-bottom: 20px;
}
</style>
