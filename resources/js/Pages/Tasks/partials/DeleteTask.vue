<script setup>
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const deletingTask = ref(false);
const props = defineProps(['task']);

const form =useForm({
    title: props.task.title,
    description: props.task.description,
    progress: props.task.progress,
});

const deleteTask = () => {
    deletingTask.value = true;
};

const closeModal = () => {
    deletingTask.value = false;
}

const destroyTask = () => {
    form.delete(route('tasks.destroy',props.task.id),{
        onSuccess: () => closeModal(),
    });
}

</script>

<template>

    <DangerButton @click="deleteTask"><i class="fa fa-trash-o text-sm"></i></DangerButton>
    <section>
        <Modal :show="deletingTask" @close="closeModal">
            <!-- Head -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl">
                    Delete Task {{ task.title }}?
                </h3>
                <button type="button" class="text-gray-900 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" @click="closeModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Body -->
            <div class="flex items-center justify-start m-10">
                <h1>
                    Are you sure you want to delete {{ task.title }}?
                </h1>
            </div>
            <div class="flex justify-end m-4">
                <form @submit.prevent="destroyTask">
                    <DangerButton>Delete</DangerButton>
                </form>
            </div>
        </Modal>
    </section>

</template>
