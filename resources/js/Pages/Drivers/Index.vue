<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage, } from '@inertiajs/vue3';
import Sidebar from "@/Layouts/Sidebar.vue";
import MainContent from "@/Layouts/MainContent.vue";
import {ref} from "vue";

defineProps({
    drivers: Object
})

const showMsg = ref(false);

const deleteDriver = (id) => {
    if (confirm('Are you sure you want to delete this driver?')) {
        router.delete(`drivers/${id}`);
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
    <Head title="Drivers" />

    <AuthenticatedLayout>
        <div class="content-wrapper">
            <Sidebar />
            <MainContent>
                <div class="drivers max-w-7xl mx-auto sm:px-6 lg:px-8 m-5">
                    <div class="drivers-list">
                        <div class="">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-3 px-5">
                                <div class="text-gray-900 text-2xl">Drivers List</div>
                                <p>Manage Drivers in the system</p>
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
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>

                                    <th scope="col" class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="p-2">
                                <tr v-for="driver in drivers" :key="driver.id">
                                    <th scope="row">{{ driver.id }}</th>
                                    <td>{{ driver.name }}</td>
                                    <td>{{ driver.phone }}</td>
                                    <td>{{ driver.email }}</td>
                                    <td class="text-right">
                                        <a :href="route('drivers.edit',driver.id)" class="btn btn-link">View</a>
                                        <a href="#" @click="deleteDriver(driver.id)" class="btn btn-link text-red-600">Delete</a>
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
