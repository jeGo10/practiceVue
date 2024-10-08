<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import CreateProject from './Partials/CreateProject.vue';
import EditProject from './Partials/EditProject.vue';
import DeleteProject from './Partials/DeleteProject.vue';

const props = defineProps({
    projects: { type: Array, default: () => [] },
    divisions: { type: Array, default: () => [] },
    auth: { type: Object, default: () => ({ user: { role: '' } }) }
});

// check admin role
const isAdmin = computed(() => props.auth.user?.roles.some(role => role.name === 'admin'));

// Create a computed property to map division IDs to names
const divisionNameMap = computed(() => {
    return props.divisions.reduce((map, division) => {
        map[division.id] = division.name;
        return map;
    }, {});
});
</script>

<template>
    <Head title="Project"/>
    <AuthenticatedLayout>
        <div class="container mx-auto mt-4">
            <div class="mx-auto border rounded-lg shadow-lg card max-w-fit">
                <div class="flex items-center justify-between p-4 bg-gray-100 card-header">
                    <h1 class="text-4xl font-bold uppercase">Projects</h1>
                    <div v-if="isAdmin" class="ml-auto">
                        <CreateProject :divisions="divisions" />
                    </div>
                </div>
                <div class="p-4 card-body">
                    <div class="w-full min-h-96">
                        <table class="table-fixed w-full border border-gray-200 border-collapse text-center">
                            <thead>
                                <tr class="bg-gray-300">
                                    <th class="p-2 w-14">No.</th>
                                    <th class="p-2">Project Title</th>
                                    <th class="p-2">Status</th>
                                    <th class="p-2">Division</th>
                                    <th class="p-2">Date Created</th>
                                    <th v-if="isAdmin" class="p-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(project, index) in props.projects" :key="project.id" class="border-b hover:bg-gray-100 even:bg-gray-50">
                                    <td class="p-2 w-14">{{ index + 1 }}</td>
                                    <td class="p-2">{{ project.title }}</td>
                                    <td class="p-2">
                                        <span v-if="project.status == 1" class="px-2 py-1 text-white bg-green-500 rounded">Active</span>
                                        <span v-else class="px-2 py-1 text-white bg-red-500 rounded">Inactive</span>
                                    </td>
                                    <td class="p-2">{{ divisionNameMap[project.division_id] || 'Division is Inactive' }}</td>
                                    <td class="p-2">{{ new Date(project.created_at).toLocaleDateString('en-US') }}</td>
                                    <td v-if="isAdmin" class="p-2">
                                        <div class="flex justify-center space-x-2">
                                            <!-- Edit and Delete -->
                                            <EditProject :projects="project" :divisions="divisions"/>
                                            <DeleteProject :projects="project" :divisions="divisions"/>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
