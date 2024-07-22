<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const creatingTask = ref(false);

const form = useForm({
    title: '',
    description: '',
});

const createTask = () => {
    creatingTask.value = true;
};

const closeModal = () => {
    creatingTask.value = false;

    form.reset();
}

const addTask = () => {
    form.post(route('tasks.index'), {
        onSuccess: () => closeModal(),
    });
}

</script>

<template>
    <PrimaryButton @click="createTask">Add Task</PrimaryButton>

    <section>
    <Modal :show="creatingTask" @close="closeModal">
        <!-- Head -->
        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl">
            Add a new Task
        </h3>
        <button type="button" class="text-gray-900 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="closeModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        </div>

        <!-- Body -->
        <div class="flex items-center justify-center m-10">
            <form @submit.prevent="submit">
        <div class="space-y-4">
            <div class="grid">
                <InputLabel for="title" value="Title"/>
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    placeholder="Title"
                    required
                    />
            </div>
            <div class="grid">
                <InputLabel for="description" value="Description"/>
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    placeholder="Description"
                    required
                    />
            </div>
            <div class="flex justify-center items-center">
                <PrimaryButton
                    class="border rounded-lg bg-green-500 hover:bg-green-700 text-neutral-50 px-6 py-4"
                    :disabled="form.processing"
                    @click="addTask"
                    >
                    Save New Task
                </PrimaryButton>
            </div>
        </div>
    </form>
</div>
    </Modal>
</section>

</template>
