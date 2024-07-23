<script setup>
import { onMounted, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateTasks from './partials/CreateTasks.vue';
import UpdateTask from './partials/UpdateTask.vue';
import DeleteTask from './partials/DeleteTask.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['tasks']);

// Filter tasks based on their completion status
const completeTasks = computed(() => props.tasks.filter(task => task.progress === 1));
const incompleteTasks = computed(() => props.tasks.filter(task => task.progress !== 1));

// Add DOM event listeners when component is mounted
onMounted(() => {
    const tabs = document.querySelectorAll('[data-toggle="tab"]');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active class from all tabs
            tabs.forEach(tab => tab.classList.remove('text-blue-700'));
            tabPanes.forEach(pane => pane.classList.add('hidden'));

            // Add active class to the clicked tab
            tab.classList.add('text-blue-700');
            document.querySelector(tab.getAttribute('href')).classList.remove('hidden');
        });
    });
});
</script>

<template>
    <Head title="Tasks"/>
    <AuthenticatedLayout>

        <!-- Body -->
        <div class="container max-w-4xl mx-auto p-4">
            <div class="bg-white border-b border-gray-100 shadow sm:rounded-lg">
                <div class="flex justify-between items-center pt-4 mx-12">
                    <h1 class="text-xl">Tasks</h1>
                    <!-- Tab Navigation -->
                    <div class="flex w-80 border-neutral-600 bg-white shadow sm:rounded-lg ml-auto">
                        <ul class="flex justify-center w-full">
                            <li class="mr-4 border-b-2 border-transparent uppercase tracking-wider text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <a href="#all" class="inline-block px-4 py-2 text-sm font-medium" data-toggle="tab">All</a>
                            </li>
                            <li class="mr-4 border-b-2 border-transparent uppercase tracking-wider text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <a href="#complete" class="inline-block px-4 py-2 text-sm font-medium" data-toggle="tab">Complete</a>
                            </li>
                            <li class="mr-0 border-b-2 border-transparent uppercase tracking-wider text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <a href="#incomplete" class="inline-block px-4 py-2 text-sm font-medium" data-toggle="tab">Incomplete</a>
                            </li>
                        </ul>
                    </div>
                    <div class="ml-auto">
                        <CreateTasks />
                    </div>
                </div>
                <section class="flex justify-center">
                    <div class="max-w-3xl tab-content">
                        <div id="all" class="tab-pane">
                            <div class="py-4">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Date</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Title</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Description</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Progress</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="task in props.tasks" :key="task.id">
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border border-black/10 text-center">
                                                {{ new Date(task.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' }) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">{{ task.title }}</td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">{{ task.description }}</td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">
                                                <p v-if="task.progress == 1" class="text-green-500">Complete</p>
                                                <p v-else class="text-red-500">Incomplete</p>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border border-black/10">
                                                <div class="flex items-center space-x-4">
                                                    <UpdateTask :task="task"/>
                                                    <DeleteTask :task="task"/>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="complete" class="tab-pane hidden">
                            <div class="py-4">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Date</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Title</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Description</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Progress</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="task in completeTasks" :key="task.id">
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border border-black/10 text-center">
                                                {{ new Date(task.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' }) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">{{ task.title }}</td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">{{ task.description }}</td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">
                                                <p class="text-green-500">Complete</p>
                                            </td>
                                            <td class="flex justify-center px-6 py-4 text-sm font-medium text-gray-900 border border-black/10">
                                                <div class="flex items-center space-x-4">
                                                    <UpdateTask :task="task"/>
                                                    <DeleteTask :task="task"/>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="incomplete" class="tab-pane hidden">
                            <div class="py-4">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Date</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Title</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Description</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Progress</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium border-b text-neutral-50 bg-neutral-700 uppercase tracking-wider text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="task in incompleteTasks" :key="task.id">
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border border-black/10 text-center">
                                                {{ new Date(task.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' }) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">{{ task.title }}</td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">{{ task.description }}</td>
                                            <td class="px-6 py-4 text-sm border border-black/10 text-center">
                                                <p class="text-red-500">Incomplete</p>
                                            </td>
                                            <td class="flex justify-center px-6 py-4 text-sm font-medium text-gray-900 border border-black/10">
                                                <div class="flex items-center space-x-4">
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
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
