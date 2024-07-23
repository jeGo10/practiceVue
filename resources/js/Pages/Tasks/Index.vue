<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateTasks from './partials/CreateTasks.vue';
import UpdateTask from './partials/UpdateTask.vue';
import DeleteTask from './partials/DeleteTask.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['tasks']);

// Reactive variable to track the current tab
const currentTab = ref('all');

// Filter tasks based on their completion status
const completeTasks = computed(() => props.tasks.filter(task => task.progress === 1));
const incompleteTasks = computed(() => props.tasks.filter(task => task.progress !== 1));
</script>

<template>
    <Head title="Tasks"/>
    <AuthenticatedLayout>
        <!-- Body -->
        <div class="container mx-auto mt-4">
            <div class="card border rounded-lg shadow-lg">
                <div class="card-header flex justify-between items-center p-4 bg-gray-100">
                    <h1 class="text-xl font-bold">Tasks</h1>
                    <div class="justify-end">
                        <CreateTasks />
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- All Tasks Tab -->
                     <!-- Tab Navigation -->
                    <ul class="nav nav-tabs flex border-b">
                        <li class="nav-item">
                            <a
                                @click="currentTab = 'all'"
                                :class="{'nav-link': true, 'border-b-2': currentTab === 'all', 'border-blue-500': currentTab === 'all', 'text-gray-500': currentTab === 'all', 'hover:border-blue-500': currentTab !== 'all'}"
                                href="#all"
                            >
                                All
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                @click="currentTab = 'complete'"
                                :class="{'nav-link': true, 'border-b-2': currentTab === 'complete', 'border-blue-500': currentTab === 'complete', 'text-gray-500': currentTab === 'complete', 'hover:border-blue-500': currentTab !== 'complete'}"
                                href="#complete"
                            >
                                Complete
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                @click="currentTab = 'incomplete'"
                                :class="{'nav-link': true, 'border-b-2': currentTab === 'incomplete', 'border-blue-500': currentTab === 'incomplete', 'text-gray-500': currentTab === 'incomplete', 'hover:border-blue-500': currentTab !== 'incomplete'}"
                                href="#incomplete"
                            >
                                Incomplete
                            </a>
                        </li>
                    </ul>
                    <div v-if="currentTab === 'all'">
                        <table class="table-auto w-full border border-gray-200">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-2">Date</th>
                                    <th class="p-2">Title</th>
                                    <th class="p-2">Description</th>
                                    <th class="p-2">Progress</th>
                                    <th class="p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in props.tasks" :key="task.id">
                                    <td class="p-2">{{ new Date(task.created_at).toLocaleDateString('en-US') }}</td>
                                    <td class="p-2">{{ task.title }}</td>
                                    <td class="p-2">{{ task.description }}</td>
                                    <td class="p-2">
                                        <span v-if="task.progress == 1" class="bg-green-500 text-white py-1 px-2 rounded">Complete</span>
                                        <span v-else class="bg-red-500 text-white py-1 px-2 rounded">Incomplete</span>
                                    </td>
                                    <td class="p-2">
                                        <div class="flex space-x-2">
                                            <UpdateTask :task="task"/>
                                            <DeleteTask :task="task"/>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Complete Tasks Tab -->
                    <div v-if="currentTab === 'complete'">
                        <table class="table-auto w-full border border-gray-200">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-2">Date</th>
                                    <th class="p-2">Title</th>
                                    <th class="p-2">Description</th>
                                    <th class="p-2">Progress</th>
                                    <th class="p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in completeTasks" :key="task.id">
                                    <td class="p-2">{{ new Date(task.created_at).toLocaleDateString('en-US') }}</td>
                                    <td class="p-2">{{ task.title }}</td>
                                    <td class="p-2">{{ task.description }}</td>
                                    <td class="p-2">
                                        <span class="bg-green-500 text-white py-1 px-2 rounded">Complete</span>
                                    </td>
                                    <td class="p-2">
                                        <div class="flex space-x-2">
                                            <UpdateTask :task="task"/>
                                            <DeleteTask :task="task"/>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Incomplete Tasks Tab -->
                    <div v-if="currentTab === 'incomplete'">
                        <table class="table-auto w-full border border-gray-200">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-2">Date</th>
                                    <th class="p-2">Title</th>
                                    <th class="p-2">Description</th>
                                    <th class="p-2">Progress</th>
                                    <th class="p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="task in incompleteTasks" :key="task.id">
                                    <td class="p-2">{{ new Date(task.created_at).toLocaleDateString('en-US') }}</td>
                                    <td class="p-2">{{ task.title }}</td>
                                    <td class="p-2">{{ task.description }}</td>
                                    <td class="p-2">
                                        <span class="bg-red-500 text-white py-1 px-2 rounded">Incomplete</span>
                                    </td>
                                    <td class="p-2">
                                        <div class="flex space-x-2">
                                            <UpdateTask :task="task"/>
                                            <DeleteTask :task="task"/>
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
