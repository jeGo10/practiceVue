<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/DICT_Standard_Sub-brand_Logo.png/640px-DICT_Standard_Sub-brand_Logo.png" style="width: auto; height: 200px; ">
        </div>
        <div class="w-full sm:max-w-lg mt-1 px-3 py-4 text-center" style="font-family: helvetica, sans-serif; font-size: 22px; color: #235596">

            <div class="typewriter poppins-thin"><h3><strong>Regional Office IX and BASULTA</strong></h3></div>
            <div class="typewriter poppins-regular"><h1>QUALITY MANAGEMENT SYSTEM <br>PORTAL</h1></div>
            <div class="typewriter poppins-thin" ><h4><strong>v.01</strong></h4></div>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
