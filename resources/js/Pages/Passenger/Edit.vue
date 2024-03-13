<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Sidebar from "@/Layouts/Sidebar.vue";
import MainContent from "@/Layouts/MainContent.vue";
import {ref} from "vue";

const props = defineProps({
    passenger: Object
});

const editForm = ref(false);
const isReadOnly = ref(true);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
    identity_card: '',
    hire_rate: '',
    status: 'active',
    is_banned: '0',
});

// dynamically set the form values as get in props
form.name = props.passenger.name;
form.email = props.passenger.email;
form.phone = props.passenger.phone;
form.address = props.passenger.address;
form.identity_card = props.passenger.identity_card;
form.hire_rate = props.passenger.hire_rate;
form.status = props.passenger.status;
form.is_banned = props.passenger.is_banned;

const enableFormEdit = (e) => {
    e.preventDefault();
    editForm.value = true;
    isReadOnly.value = false;
}

const sumitEditDriver = (e) => {
    e.preventDefault();
    form.put(route('passenger.update', props.passenger.id), {
        onSuccess: () => {
            form.recentlySuccessful = true;
        },
        onFinish: () => {
            editForm.value = false;
            isReadOnly.value = true;
        }
    });

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
                                <div class="text-gray-900 text-2xl">Passenger : {{form.name}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="drivers-list-table mt-5 p-4 bg-white">
                        <form @submit="sumitEditDriver">
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="drive_email" class="form-label">Email address</label>
                                    <input :readonly="isReadOnly" type="email" v-model="form.email" class="form-control" id="drive_email" aria-describedby="emailHelp">
                                    <div v-if="form.errors.email" class="form-text text-red-600">{{form.errors.email}}</div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="driver_name" class="form-label">Name</label>
                                    <input :readonly="isReadOnly" type="text" v-model="form.name" class="form-control" id="driver_name">
                                    <div v-if="form.errors.name" class="form-text text-red-600">{{form.errors.name}}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input :readonly="isReadOnly" type="text" v-model="form.phone" class="form-control" id="phone">
                                    <div v-if="form.errors.phone" class="form-text text-red-600">{{form.errors.phone}}</div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="identity_card" class="form-label">Identity Card NO</label>
                                    <input :readonly="isReadOnly" type="text" v-model="form.identity_card" class="form-control" id="identity_card">
                                    <div v-if="form.errors.identity_card" class="form-text text-red-600">{{form.errors.identity_card}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input :readonly="isReadOnly" type="text" v-model="form.address" class="form-control" id="address">
                                    <div v-if="form.errors.address" class="form-text text-red-600">{{form.errors.address}}</div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select :disabled="isReadOnly"  v-model="form.status" name="status" class="form-select" id="status">
                                        <option value="ACTIVE">Active</option>
                                        <option value="INACTIVE">Inactive</option>
                                    </select>
                                    <div v-if="form.errors.status" class="form-text text-red-600">{{ form.errors.status }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="is_banned" class="form-label">Banned This Account</label>
                                    <select :disabled="isReadOnly" v-model="form.is_banned" name="is_banned" class="form-select" id="is_banned">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    <div v-if="form.errors.is_banned" class="form-text text-red-600">{{ form.errors.is_banned }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="flex gap-3 justify-between">
                                    <div class="actions gap-3 flex">
                                        <button type="submit" class="btn btn-primary bg-black" @click="enableFormEdit">Edit Form</button>
                                        <button type="submit" class="btn btn-primary bg-green-700" :disabled="!editForm" >Save Form</button>
                                        <Transition
                                            enter-active-class="transition ease-in-out"
                                            enter-from-class="opacity-0"
                                            leave-active-class="transition ease-in-out"
                                            leave-to-class="opacity-0 text-green-600"
                                        >
                                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{$page.props.flash.success}}</p>
                                        </Transition>
                                    </div>
                                </div>
                            </div>
                        </form>
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
input:read-only {
    background-color: #e9e9e9;
    opacity: 0.5;
}
</style>
