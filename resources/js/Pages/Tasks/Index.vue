<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateTasks from './partials/CreateTasks.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps(['tasks']);
</script>

<template>
    <Head title="Tasks"/>
    <AuthenticatedLayout>
        <div class="flex justify-center mt-4">
            <CreateTasks />
        </div>
        <section class="flex justify-center">
            <div class="max-w-4xl tab-content">
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
                                <tr v-for="task in tasks" :key="task.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border border-black/10 text-center">
                                        {{ new Date(task.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' }) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm border border-black/10 text-center">{{ task.title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm border border-black/10 text-center">{{ task.description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm border border-black/10 text-center">
                                        <!-- Progress info can be added here -->
                                    </td>
                                    <td class="flex justify-center px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border border-black/10">
                                        <div class="flex items-center space-x-4">
                                            <!-- Action buttons can be added here -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
