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
        ? 'flex items-center px-1 py-3 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-slate-400 hover:text-slate-50 focus:outline-none focus:border-indigo-700 no-underline'
        : 'flex items-center px-1 py-3 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-400 hover:text-slate-50 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 no-underline'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
