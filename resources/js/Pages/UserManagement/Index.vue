<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import RegisterUser from './partials/RegisterUser.vue';

const props = defineProps(['users']);

</script>

<template>
    <Head title="User Management"/>
    <AuthenticatedLayout>
        <div class="container mx-auto mt-4">
            <div class="card border rounded-lg shadow-lg">
                <div class="card-header flex justify-between items-center p-4 bg-gray-100">
                    <h1 class="text-xl font-bold">User Management</h1>
                    <div class="ml-auto">
                        <RegisterUser/>
                    </div>
                </div>
                <div class="card-body p-4">
                    <table class="table-auto w-full border border-gray-200">
                        <thead>
                            <tr class="bg-gray-300">
                                <th class="p-2">User Name</th>
                                <th class="p-2">Email</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Role</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100">
                                <td class="p-2">{{ user.name }}</td>
                                <td class="p-2">{{ user.email }}</td>
                                <td class="p-2">
                                    <!-- User Status -->
                                </td>
                                <td class="p-2 text-uppercase">
                                    <!-- Role -->
                                    {{ user.roles ? user.roles.map(role => role.name).join(', ') : 'No Role' }}
                                </td>
                                <td class="p-2">
                                    <div class="flex space-x-2">
                                        <!-- Update and Delete Button -->
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
