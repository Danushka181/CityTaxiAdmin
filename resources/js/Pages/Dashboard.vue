<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from "@/Layouts/Sidebar.vue";
import MainContent from "@/Layouts/MainContent.vue";
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
