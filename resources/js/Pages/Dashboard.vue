<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
import Sidebar from "@/Layouts/Sidebar.vue";
import MainContent from "@/Layouts/MainContent.vue";

defineProps({
    totalDrivers: Number,
    totalPassengers: Number,
    totalRevenue: Number,
    totalTrips: Number,
    totalTripsThisMonth: Number,
    totalTripsToday: Number,
    totalVehicles: Number,
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="content-wrapper">
            <Sidebar />
            <MainContent>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">Hello  {{ $page.props.auth.user.name }}!!</div>
                        </div>
                    </div>
                </div>
                <ul class="flex items-start justify-between gap-8 mt-0 md:flex-row flex-col p-8 pt-0">
                    <li
                        class="w-full lg:w-[32%] px-0 pt-16 pb-8 bg-white rounded-lg self-stretch hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)] transition-all duration-150 ease-in relative group">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 rounded-br-xl rounded-bl-xl text-white px-8 py-2 bg-[#ff2865] transition-all duration-150 ease-in group-hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)]">
                            Passengers
                        </div>
                        <h2
                            class="text-center font-semibold text-lg tracking-wider mb-3 drop-shadow-[3px_3px_5px_rgba(91,91,91,0.58)]">
                            Registered Passengers</h2>
                        <p class="text-center tracking-tighter block mb-6">
                            <span class="text-4xl font-bold">{{ totalPassengers }} </span>
                            <span class="text-black/40 text-center"> / Passengers</span>
                        </p>
                        <Link
                            href="/passenger"
                            class="flex items-center justify-center px-0 py-0 mr-3 text-base font-medium text-center text-red-500 rounded-lg  hover:text-amber-500">
                            View Passengers
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </Link>
                    </li>

                    <li
                        class="w-full lg:w-[32%] px-0  pt-16 pb-8 bg-white rounded-lg self-stretch hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)] transition-all duration-150 ease-in relative group">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 rounded-br-xl rounded-bl-xl text-white px-8 py-2 bg-[#ff2865] transition-all duration-150 ease-in group-hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)]">
                            Drivers
                        </div>
                        <h2
                            class="text-center font-semibold text-lg tracking-wider mb-3 drop-shadow-[3px_3px_5px_rgba(91,91,91,0.58)]">
                            Registered Drivers</h2>
                        <p class="text-center tracking-tighter block mb-6">
                            <span class="text-4xl font-bold">{{ totalDrivers }}</span>
                        </p>
                        <Link
                            :href="route('drivers.index')"
                            class="flex items-center justify-center px-0 py-0 mr-3 text-base font-medium text-center text-red-500 rounded-lg  hover:text-amber-500">
                            View Drivers
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </Link>
                    </li>
                    <li
                        class="w-full lg:w-[32%] px-0  pt-16 pb-8 bg-white rounded-lg self-stretch hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)] transition-all duration-150 ease-in relative group">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 rounded-br-xl rounded-bl-xl text-white px-8 py-2 bg-[#ff2865] transition-all duration-150 ease-in group-hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)]">
                            Vehicles
                        </div>
                        <h2
                            class="text-center font-semibold text-lg tracking-wider mb-3 drop-shadow-[3px_3px_5px_rgba(91,91,91,0.58)]">
                            Total Active Vehicles</h2>
                        <p class="text-center tracking-tighter block mb-6">
                            <span class="text-4xl font-bold">{{ totalVehicles }}</span>
                            <span class="text-black/40 text-center"> / Vehicle</span>
                        </p>
                        <Link
                            :href="route('vehicle.index')"
                            class="flex items-center justify-center px-0 py-0 mr-3 text-base font-medium text-center text-red-500 rounded-lg  hover:text-amber-500">
                            View Vehicles
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </Link>
                    </li>
                </ul>
                <ul class="flex items-start justify-between gap-8 mt-0 md:flex-row flex-col p-8 pt-0">

                    <li
                        class="w-full lg:w-[32%] px-0  pt-16 pb-8 bg-white rounded-lg self-stretch hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)] transition-all duration-150 ease-in relative group">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 rounded-br-xl rounded-bl-xl text-white px-8 py-2 bg-[#ff2865] transition-all duration-150 ease-in group-hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)]">
                            Trips
                        </div>
                        <h2
                            class="text-center font-semibold text-lg tracking-wider mb-3 drop-shadow-[3px_3px_5px_rgba(91,91,91,0.58)]">
                            Total Trips</h2>
                        <p class="text-center tracking-tighter block mb-6">
                            <span class="text-4xl font-bold">{{ totalTrips }}</span>
                        </p>
                        <Link
                            :href="route('trips.index')"
                            class="flex items-center justify-center px-0 py-0 mr-3 text-base font-medium text-center text-red-500 rounded-lg  hover:text-amber-500">
                            View Trips
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </Link>
                    </li>

                    <li
                        class="w-full lg:w-[32%] px-0  pt-16 pb-8 bg-white rounded-lg self-stretch hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)] transition-all duration-150 ease-in relative group">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 rounded-br-xl rounded-bl-xl text-white px-8 py-2 bg-[#ff2865] transition-all duration-150 ease-in group-hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)]">
                            Trips
                        </div>
                        <h2
                            class="text-center font-semibold text-lg tracking-wider mb-3 drop-shadow-[3px_3px_5px_rgba(91,91,91,0.58)]">
                            Trips for Today</h2>
                        <p class="text-center tracking-tighter block mb-6">
                            <span class="text-4xl font-bold">{{ totalTripsThisMonth }}</span>
                        </p>
                        <Link
                            :href="route('trips.index')"
                            class="flex items-center justify-center px-0 py-0 mr-3 text-base font-medium text-center text-red-500 rounded-lg  hover:text-amber-500">
                            View Trips
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </Link>
                    </li>
                    <li
                        class="w-full lg:w-[32%] px-0  pt-16 pb-8 bg-white rounded-lg self-stretch hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)] transition-all duration-150 ease-in relative group">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 rounded-br-xl rounded-bl-xl text-white px-8 py-2 bg-[#ff2865] transition-all duration-150 ease-in group-hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)]">
                            Trips
                        </div>
                        <h2
                            class="text-center font-semibold text-lg tracking-wider mb-3 drop-shadow-[3px_3px_5px_rgba(91,91,91,0.58)]">
                            Trips for This Month</h2>
                        <p class="text-center tracking-tighter block mb-6">
                            <span class="text-4xl font-bold">{{ totalTripsThisMonth }}</span>
                        </p>
                        <Link
                            :href="route('trips.index')"
                            class="flex items-center justify-center px-0 py-0 mr-3 text-base font-medium text-center text-red-500 rounded-lg  hover:text-amber-500">
                            View Trips
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </Link>
                    </li>
                </ul>
                <ul class="flex items-start justify-between gap-8 mt-0 md:flex-row flex-col p-8 pt-0">
                    <li
                        class="w-full lg:w-[32%] px-0 pt-16 pb-8 bg-white rounded-lg self-stretch hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)] transition-all duration-150 ease-in relative group">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 rounded-br-xl rounded-bl-xl text-white px-8 py-2 bg-[#ff2865] transition-all duration-150 ease-in group-hover:shadow-[0px_14px_28px_-5px_rgba(0,0,0,0.1)]">
                            Revenue
                        </div>
                        <h2
                            class="text-center font-semibold text-lg tracking-wider mb-3 drop-shadow-[3px_3px_5px_rgba(91,91,91,0.58)]">
                            Total Revenue</h2>
                        <p class="text-center tracking-tighter block mb-6">
                            <span class="text-4xl font-bold">{{ totalRevenue }} </span>
                            <span class="text-black/40 text-center"> / RS</span>
                        </p>
                    </li>
                </ul>
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
