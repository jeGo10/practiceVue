<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'flex items-center w-full p-2 text-gray-300 hover:text-white bg-slate-600 transition duration-75 rounded-lg group focus:outline-none no-underline'
        : 'flex items-center w-full p-2 text-gray-300 hover:text-white hover:bg-slate-600 transition duration-75 rounded-lg no-underline'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
