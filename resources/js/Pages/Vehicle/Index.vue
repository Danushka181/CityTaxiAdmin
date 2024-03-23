<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage, } from '@inertiajs/vue3';
import Sidebar from "@/Layouts/Sidebar.vue";
import MainContent from "@/Layouts/MainContent.vue";
import {ref} from "vue";

defineProps({
    vehicles: Object
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
                                <div class="text-gray-900 text-2xl">Vehicles List</div>
                                <p>Manage Vehicles in the system</p>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Driver Name</th>

                                    <th scope="col" class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="p-2">
                                <tr v-for="vehicle in vehicles" :key="vehicle.id">
                                    <th scope="row">{{ vehicle.id }}</th>
                                    <td>{{ vehicle.name }}</td>
                                    <td>{{ vehicle.number }}</td>
                                    <td>{{ vehicle.car_type.name }}</td>
                                    <td>{{ vehicle.driver.name }}</td>
                                    <td class="text-right">
                                        <a :href="route('vehicle.show',vehicle.id)" class="btn btn-link">View</a>
                                        <a href="#" @click="deleteVehicle(vehicle.id)" class="btn btn-link text-red-600">Delete</a>
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
.content-wrapper{
    display: grid;
    grid-template-columns: 300px 1fr;
    max-width: 1300px;
    margin: 0 auto;
}
</style>
