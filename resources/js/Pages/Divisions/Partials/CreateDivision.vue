<script setup>

import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';


const creatingDivision = ref(false);

const form = useForm({
    title: '',
});

const createDivision = () => {
    creatingDivision.value = true;
};

const closeModal = () => {
    creatingDivision.value = false;

    form.reset();
}

const addDivision = () => {
    form.post(route('tasks.store'), {
        onSuccess: () => closeModal(),
    });
}
</script>

<template>
        <PrimaryButton @click="createDivision">Add Division</PrimaryButton>

    <section>
    <Modal :show="creatingDivision" @close="closeModal">
        <!-- Head -->
        <div class="flex items-center justify-between p-4 border-b rounded-t ">
        <h3 class="text-xl">
            Add a new Division
        </h3>
        <button type="button" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" @click="closeModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        </div>

      
        <div class="flex items-center justify-center m-10">
            <form @submit.prevent="submit">
        <div class="space-y-4">
            <div>
                <InputLabel for="title" value="Division"/>
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    placeholder="Enter Division"
                    required
                    />
            </div>
            <div>
                            <InputLabel for="progress" value="Status"/>
                            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="progress" v-model="form.progress" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
            <div class="flex justify-center items-center">
                <PrimaryButton
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
