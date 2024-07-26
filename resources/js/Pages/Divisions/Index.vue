<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import CreateDivision from './Partials/CreateDivision.vue';

const divisions = ref([]);



</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto mt-4">
            <div class="card border rounded-lg shadow-lg">
                <div class="card-header flex justify-between items-center p-4 bg-gray-100">
                    <h1 class="text-xl font-bold">Division</h1>
                    
                    <div>
                        <CreateDivision />
                    </div>
                </div>   
                <div class="card-body p-4">
                    <!-- All Tasks Tab -->
                     <!-- Tab Navigation -->
                     <ul class="nav nav-tabs flex">
                        <li class="nav-item">
                            <a
                                class="text-dark"
                                @click="currentTab = 'all'"
                                :class="{
                                    'nav-link': true,
                                    'active': currentTab === 'all',
                                }"
                                href="#all"> All
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="text-dark"
                                @click="currentTab = 'active'"
                                :class="{
                                    'nav-link': true,
                                    'active': currentTab === 'active'
                                }"
                                href="#active"> Active
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="text-dark"
                                @click="currentTab = 'inactive'"
                                :class="{
                                    'nav-link': true,
                                    'active': currentTab === 'inactive'
                                }"
                                href="#inactive"> Inactive
                            </a>
                        </li>
                    </ul>
                
                        <div class="flex justify-left">
                            <div class="w-full max-w-screen-lg">
                                <table class="table-auto w-full border border-gray-200 border-collapse">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="p-2 border-b-2 border-r border-gray-300">Division</th>
                                            <th class="p-2 border-b-2 border-r border-gray-300">Status</th>
                                            <th class="p-2 border-b-2 border-gray-300">Date & Time</th>
                                            <th class="p-2 border-b-2 border-gray-300">Actions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(division, index) in divisions" :key="index">
                                            <td class="p-2 border-b border-r border-gray-300">
                                                <input type="text" v-model="division.name" class="border border-gray-300 p-1 w-full">
                                            </td>
                                            <td class="p-2 border-b border-r border-gray-300">Status Placeholder</td>
                                            <td class="p-2 border-b border-gray-300">Date & Time Placeholder</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                
            </div>
        </div>                    
       
    </AuthenticatedLayout>
</template>
