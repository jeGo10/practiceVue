<script setup>
import { ref, onMounted, watch } from 'vue';
import NavLink from '@/Components/NavLink.vue';

// Initialize the isOpen state with the value from localStorage
const isOpen = ref(JSON.parse(localStorage.getItem('dropdownOpen')) || false);

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
};

// Watch the isOpen state and update localStorage whenever it changes
watch(isOpen, (newValue) => {
    localStorage.setItem('dropdownOpen', JSON.stringify(newValue));
});

// Ensure the state is initialized correctly when the component is mounted
onMounted(() => {
    isOpen.value = JSON.parse(localStorage.getItem('dropdownOpen')) || false;
});
</script>

<template>
    <div>
        <button @click="toggleDropdown" class="flex items-center w-full p-2 text-gray-300 hover:text-white hover:bg-slate-600 transition duration-75 rounded-t-lg group" :class="{'bg-slate-900':isOpen,}">
            <i class="fa fa-gear text-lg"></i>
            <span class="flex-1 ms-2 text-left rtl:text-right whitespace-nowrap">QMS</span>
            <i :class="{'rotate-90': isOpen}" class="fa fa-angle-left text-lg font-bold transition-transform duration-200"></i>
        </button>
        <transition name="slide-fade">
            <ul v-show="isOpen" class="p-2 space-y-2 bg-slate-900 rounded-b-lg">
                <li>
                    <NavLink>
                        <i class="fa fa-book text-lg"></i><span class="ml-2">Manuals</span>
                    </NavLink>
                </li>
                <li>
                    <NavLink :href="route('forms.index')" :active="route().current('forms.index')">
                        <i class="fa fa-file-pdf-o text-lg"></i><span class="ml-2">Forms</span>
                    </NavLink>
                </li>
                <li>
                    <NavLink :href="route('archives.index')" :active="route().current('archives.index')">
                        <i class="fa fa-archive text-lg"></i><span class="ml-2">Archive</span>
                    </NavLink>
                </li>
            </ul>
        </transition>
    </div>
</template>

<style scoped>
/* Transition for slide-fade effect */
.slide-fade-enter-active, .slide-fade-leave-active {
    transition: all 0.5s;
}
.slide-fade-enter-from, .slide-fade-leave-to {
    max-height: 0;
    opacity: 0;
}
.slide-fade-enter-to, .slide-fade-leave-from {
    max-height: 500px;
    opacity: 1;
}
.rotate-90 {
    transform: rotate(-90deg);
}
</style>
