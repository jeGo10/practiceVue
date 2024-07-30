<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';
import CreateDivision from './Partials/CreateDivision.vue';
import UpdateDivision from './Partials/UpdateDivision.vue';
import DeleteDivision from './Partials/DeleteDivision.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['divisions']);

// Reactive variable to track the current tab
const currentTab = ref('all');

// Filter tasks based on their completion status
const activeDivision = computed(() => props.divisions.filter(division => division.status === 1));
const inactiveDivision = computed(() => props.divisions.filter(division => division.status !== 1));

</script>

<template>
    <Head title="Division"/>
    <AuthenticatedLayout>
        <div class="container mx-auto mt-4">
            <div class="card max-w-7xl mx-auto border rounded-lg shadow-lg">
                <div class="card-header flex justify-between items-center p-4 bg-gray-100">
                    <h1 class="text-xl font-bold">Division</h1>
                    <div class="ml-auto">
                        <CreateDivision />
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- All Tasks Tab -->
                     <!-- Tab Navigation -->
                    <div class="flex flex-col">
                        <ul class="nav nav-tabs flex bg-gray-300 rounded-t-lg">
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
                                <table class="table-auto w-full border-b border-x border-gray-200 border-collapse text-center">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="p-2">Division</th>
                                            <th class="p-2">Status</th>
                                            <th class="p-2">Date Created</th>
                                            <th class="p-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="divisions in props.divisions" :key="divisions.id">
                                            <td class="p-2">{{ divisions.name }}</td>
                                            <td class="p-2">
                                            <span v-if="divisions.status ==1" class="bg-green-500 text-white py-1 px-2 rounded">Active</span>
                                            <span v-else class="bg-red-500 text-white py-1 px-2 rounded">Inactive</span>
                                            </td>
                                            <td class="p-2">{{ new Date(divisions.created_at).toLocaleDateString('en-US') }}</td>
                                            <td class="p-2">
                                                <div class="flex space-x-2 justify-center">
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
                                <table class="table-auto w-full border-b border-x border-gray-200 border-collapse text-center">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="p-2">Division</th>
                                            <th class="p-2">Status</th>
                                            <th class="p-2">Date Created</th>
                                            <th class="p-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="divisions in activeDivision" :key="divisions.id">
                                            <td class="p-2">{{ divisions.name }}</td>
                                            <td class="p-2">
                                            <span class="bg-green-500 text-white py-1 px-2 rounded">Active</span>
                                            </td>
                                            <td class="p-2">{{ new Date(divisions.created_at).toLocaleDateString('en-US') }}</td>
                                            <td class="p-2">
                                                <div class="flex space-x-2 justify-center">
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
                                <table class="table-auto w-full border-b border-x border-gray-200 border-collapse text-center">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="p-2">Division</th>
                                            <th class="p-2">Status</th>
                                            <th class="p-2">Date Created</th>
                                            <th class="p-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="divisions in inactiveDivision" :key="divisions.id">
                                            <td class="p-2">{{ divisions.name }}</td>
                                            <td class="p-2">
                                            <span class="bg-red-500 text-white py-1 px-2 rounded">Inactive</span>
                                            </td>
                                            <td class="p-2">{{ new Date(divisions.created_at).toLocaleDateString('en-US') }}</td>
                                            <td class="p-2">
                                                <div class="flex space-x-2 justify-center">
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
