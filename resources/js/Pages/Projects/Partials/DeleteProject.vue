<script setup>
import SmallerModal from '@/Components/SmallerModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useToast } from 'vue-toastification';

const openModal = ref(false);
const props = defineProps({
    projects: { type: Array, default: () => [] },
    divisions: { type: Array, default: () => [] }
});
const toast = useToast();

const form = useForm({
    division_id: props.projects.division_id,
    title: props.projects.title,
    status: props.projects.status,
});

const deleteProject = () => {
    openModal.value = true;
};

const closeModal = () => {
    openModal.value = false;
};

const destroyProject = () => {
    form.delete(route('projects.destroy',props.projects.id),{
        onSuccess: () => {
            closeModal(),
            toast.success('Project deleted Successfully')
        },
        onError: () => {
            toast.warning('Failed to delete Project')
        }
    });
};

</script>

<template>

    <DangerButton @click="deleteProject"><i class="fa fa-trash-o text-sm"></i></DangerButton>

    <section>
        <SmallerModal :show="openModal" @close="closeModal">
            <!-- Head -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl">
                    Delete Project {{ projects.title }}?
                </h3>
                <button type="button" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" @click="closeModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Body -->
            <div class="flex items-center justify-start m-10">
                <h1 class="text-xl">
                    Are you sure you want to delete Project {{ projects.title }}?
                </h1>
            </div>
            <div class="flex justify-end m-4">
                <form @submit.prevent="destroyProject">
                    <DangerButton>Delete</DangerButton>
                </form>
            </div>
        </SmallerModal>
    </section>

</template>
