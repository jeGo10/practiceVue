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
        ? 'flex items-center py-3 text-lg font-medium leading-5 text-gray-300 hover:text-white bg-slate-600 rounded-md focus:outline-none no-underline'
        : 'flex items-center py-3 text-lg font-medium leading-5 text-gray-300 hover:text-white hover:bg-slate-600 rounded-md focus:outline-none focus:text-gray-400 no-underline'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
