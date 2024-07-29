<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import SidebarDropdown from '@/Components/SidebarDropdown.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen flex flex-col sm:flex-row">
        <!-- Sidebar -->
        <aside class="bg-slate-800 min-h-screen w-full sm:w-64 flex-shrink-0">
            <div class="h-screen flex flex-col justify-between">
                <!-- Primary Navigation Menu -->
                <div>
                    <div class="flex flex-col items-center m-2">
                        <!-- Logo -->
                        <div class="shrink-0 m-2.5 flex items-center">
                            <Link :href="route('dashboard')" class="no-underline text-white flex items-center">
                                <img src="/images/dict-logo.png" class="block h-10" alt="Logo" />
                                <span class="brand-text font-light ml-2">QMS DICT</span>
                            </Link>
                        </div>
                        <!-- Navigation Links -->
                        <div class="space-y-1 w-full flex flex-col">
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                <i class="fa fa-home text-lg"></i><span class="ml-2">Home</span>
                            </NavLink>

                            <SidebarDropdown />

                            <NavLink :href="route('divisions.index')" :active="route().current('divisions.index')">
                                <i class="fa fa-file-o text-lg"></i><span class="ml-2">Division</span>
                            </NavLink>

                            <NavLink :href="route('UserManagement.index')" :active="route().current('UserManagement.index')">
                                <i class="fa fa-users text-lg"></i><span class="ml-2">User Management</span>
                            </NavLink>
                        </div>
                    </div>
                </div>

            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Responsive Navigation Toggle -->
            <div class="sm:hidden bg-slate-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')" class="no-underline text-white flex items-center">
                                <img src="/images/dict-logo.png" class="block h-10" alt="Logo" />
                            </Link>
                            </div>
                        </div>
                        <!-- Hamburger -->
                        <div class=" flex items-center">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" class="sm:hidden bg-slate-800 border-b border-gray-100">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')"> Dashboard </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('chirps.index')" :active="route().current('chirps.index')"> Chirps </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('tasks.index')" :active="route().current('tasks.index')"> Tasks </ResponsiveNavLink>
                </div>
            </div>

            <nav class="bg-slate-800 border-b border-dark">
                <!-- Top Bar -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">

                            <!-- Navigation/Tab Links -->

                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                Welcome, {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>


            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4">
                <slot />
            </main>
        </div>
    </div>
</template>
