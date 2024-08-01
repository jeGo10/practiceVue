<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';
import CreateDivision from './Partials/CreateDivision.vue';
import UpdateDivision from './Partials/UpdateDivision.vue';
import DeleteDivision from './Partials/DeleteDivision.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    divisions: { type: Array, default: () => [] },
    auth: { type: Object, default: () => ({ user: { role: '' } }) }
});

// Reactive variable to track the current tab
const currentTab = ref('all');

// Filter tasks based on their completion status
const activeDivision = computed(() => props.divisions.filter(division => division.status === 1));
const inactiveDivision = computed(() => props.divisions.filter(division => division.status !== 1));


const isAdmin = computed(() => props.auth.user?.roles.some(role => role.name === 'admin'));
</script>

<template>
    <Head title="Division"/>
    <AuthenticatedLayout>
        <div class="container mx-auto mt-4">
            <div class="mx-auto border rounded-lg shadow-lg card max-w-7xl">
                <div class="flex items-center justify-between p-4 bg-gray-100 card-header">
                    <h1 class="text-xl font-bold">Division</h1>
                    <div v-if="isAdmin" class="ml-auto">
                        <CreateDivision />
                    </div>
                </div>
                <div class="p-4 card-body">
                    <!-- All Tasks Tab -->
                     <!-- Tab Navigation -->
                    <div class="flex flex-col">
                        <ul class="flex bg-gray-300 rounded-t-lg nav nav-tabs">
                            <li class="nav-item">
                                <a class="text-dark" @click="currentTab = 'all'" :class="{'nav-link': true,'active': currentTab === 'all', }" href="#all">
                                    All
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="text-dark" @click="currentTab = 'active'" :class="{ 'nav-link': true, 'active': currentTab === 'active' }" href="#active">
                                    Active
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="text-dark" @click="currentTab = 'incomplete'" :class="{ 'nav-link': true, 'active': currentTab === 'incomplete' }" href="#incomplete">
                                    Inactive
                                </a>
                            </li>
                        </ul>
                        <div v-if="currentTab === 'all'">
                            <div class="w-full">
                                <table class="w-full text-center border-b border-collapse border-gray-200 table-auto border-x">
                                <table class="table-fixed w-full border-b border-x border-gray-200 border-collapse text-center">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="p-2">Division</th>
                                            <th class="p-2">Status</th>
                                            <th class="p-2">Date Created</th>
                                            <th v-if="isAdmin" class="p-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="divisions in props.divisions" :key="divisions.id">
                                            <td class="p-2">{{ divisions.name }}</td>
                                            <td class="p-2">
                                            <span v-if="divisions.status ==1" class="px-2 py-1 text-white bg-green-500 rounded">Active</span>
                                            <span v-else class="px-2 py-1 text-white bg-red-500 rounded">Inactive</span>
                                            </td>
                                            <td class="p-2">{{ new Date(divisions.created_at).toLocaleDateString('en-US') }}</td>
                                            <td class="p-2">
                                                <div v-if="isAdmin" class="flex justify-center space-x-2">
                                                    <!-- Edit and Delete -->
                                                     <UpdateDivision :divisions="divisions"/>
                                                     <DeleteDivision :divisions="divisions"/>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-if="currentTab === 'active'">
                            <div class="w-full">
                                <table class="w-full text-center border-b border-collapse border-gray-200 table-auto border-x">
                                <table class="table-fixed w-full border-b border-x border-gray-200 border-collapse text-center">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="p-2">Division</th>
                                            <th class="p-2">Status</th>
                                            <th class="p-2">Date Created</th>
                                            <th v-if="isAdmin" class="p-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="divisions in activeDivision" :key="divisions.id">
                                            <td class="p-2">{{ divisions.name }}</td>
                                            <td class="p-2">
                                            <span class="px-2 py-1 text-white bg-green-500 rounded">Active</span>
                                            </td>
                                            <td class="p-2">{{ new Date(divisions.created_at).toLocaleDateString('en-US') }}</td>
                                            <td class="p-2">
                                                <div v-if="isAdmin" class="flex justify-center space-x-2">
                                                    <!-- Edit and Delete -->
                                                    <UpdateDivision :divisions="divisions"/>
                                                    <DeleteDivision :divisions="divisions"/>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-if="currentTab === 'incomplete'">
                            <div class="w-full">
                                <table class="w-full text-center border-b border-collapse border-gray-200 table-auto border-x">
                                <table class="table-fixed w-full border-b border-x border-gray-200 border-collapse text-center">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="p-2">Division</th>
                                            <th class="p-2">Status</th>
                                            <th class="p-2">Date Created</th>
                                            <th v-if="isAdmin" class="p-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="divisions in inactiveDivision" :key="divisions.id">
                                            <td class="p-2">{{ divisions.name }}</td>
                                            <td class="p-2">
                                            <span class="px-2 py-1 text-white bg-red-500 rounded">Inactive</span>
                                            </td>
                                            <td class="p-2">{{ new Date(divisions.created_at).toLocaleDateString('en-US') }}</td>
                                            <td class="p-2">
                                                <div v-if="isAdmin" class="flex justify-center space-x-2">
                                                    <!-- Edit and Delete -->
                                                    <UpdateDivision :divisions="divisions"/>
                                                    <DeleteDivision :divisions="divisions"/>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
