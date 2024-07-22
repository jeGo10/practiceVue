<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const editingTask = ref(false);
const props = defineProps(['task']);

const form = useForm({
    title: props.task.title || '',
    description: props.task.description || '',
    progress: props.task.progress || false,
});

watch(() => props.task, (newTask) => {
    form.title = newTask.title;
    form.description = newTask.description;
    form.progress = newTask.progress;
}, { immediate: true });

const updateTask = () => {
    editingTask.value = true;
};

const closeModal = () => {
    editingTask.value = false;
    form.title = props.task.title || '';
    form.description = props.task.description || '';
    form.progress = props.task.progress || false;
}

const editTask = () => {
    form.put(route('tasks.update', props.task.id), {
        onSuccess: () => closeModal(),
    });
}

</script>

<template>
    <PrimaryButton @click="updateTask" class="bg-blue-700 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-900"><i class="fa fa-edit text-white-500 text-sm"></i></PrimaryButton>

    <section>
        <Modal :show="editingTask" @close="closeModal">
            <!-- Head -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl">
                    Edit Task {{ task.title }}
                </h3>
                <button type="button" class="text-gray-900 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" @click="closeModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Body -->
            <div class="flex items-center justify-center m-10">
                <form @submit.prevent="editTask">
                    <div class="space-y-4">
                        <div>
                            <InputLabel for="title" value="Title"/>
                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                placeholder="Title"
                                required
                            />
                        </div>
                        <div>
                            <InputLabel for="description" value="Description"/>
                            <textarea
                                id="description"
                                v-model="form.description"
                                placeholder="Task description"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                            ></textarea>
                        </div>
                        <div>
                            <InputLabel for="progress" value="Progress"/>
                            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="progress" v-model="form.progress" required>
                                <option value="1">Complete</option>
                                <option value="0">Incomplete</option>
                            </select>
                        </div>
                        <div class="flex justify-center items-center">
                            <PrimaryButton
                                :disabled="form.processing"
                                type="submit"
                            >
                                Update Task
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </Modal>
    </section>
</template>
