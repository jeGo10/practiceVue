<script setup>
import { ref } from "vue";
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SmallerModal from '@/Components/SmallerModal.vue';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const openModal = ref(false);
const props = defineProps(['divisions']);
const toast = useToast();

const form = useForm({
    title: '',
    status: '',
    division_id: '', // Use division_id to match your backend field
});

const createProject = () => {
    openModal.value = true;
};

const closeModal = () => {
    openModal.value = false;
    form.reset();
};

const addProject = () => {
    form.post(route('projects.store'), {
        onSuccess: () => {
            closeModal();
            toast.success('Project added Successfully');
        },
        onError: () => {
            toast.warning('Failed to add Project');
        }
    });
};

const submit = () => {
    console.log('Form data before submit:', form);
    addProject();
};

</script>

<template>
    <PrimaryButton @click="createProject">Add Project</PrimaryButton>

    <SmallerModal :show="openModal" @close="closeModal">
        <!-- Modal Head -->
        <div class="flex items-center justify-between p-4 border-b rounded-t">
            <h3 class="text-xl">Add a new Project</h3>
            <button
                type="button"
                class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                @click="closeModal"
            >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="flex items-center justify-center m-10">
            <form @submit.prevent="submit">
                <div class="space-y-4">
                    <div>
                        <InputLabel for="title" value="Project Title"/>
                        <TextInput
                            id="title"
                            v-model="form.title"
                            type="text"
                            placeholder="Enter Project Title"
                            required
                        />
                    </div>
                    <div>
                        <InputLabel for="division" value="Division"/>
                        <select
                            id="division"
                            v-model="form.division_id"
                            class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                            <option value="" disabled>Select Division</option>
                            <option v-for="division in props.divisions" :key="division.id" :value="division.id">
                                {{ division.name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <InputLabel for="status" value="Project Status"/>
                        <select
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            id="status"
                            v-model="form.status"
                            required
                        >
                            <option value="" disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-center items-center">
                        <PrimaryButton :disabled="form.processing">
                            Create Project
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </SmallerModal>
</template>
