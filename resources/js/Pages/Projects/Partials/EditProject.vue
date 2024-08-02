<script setup>
import SmallerModal from '@/Components/SmallerModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { useToast } from 'vue-toastification';

const openModal = ref(false);
const props = defineProps({
    projects: { type: Array, default: () => [] },
    divisions: { type: Array, default: () => [] }
});
const toast = useToast();

const form = useForm({
    title: props.projects.title || '',
    status: props.projects.status || false,
    division_id: props.projects.division_id || '',
});

watch(() => props.projects, (newProject) => {
    form.title = newProject.title;
    form.status = newProject.status;
    form.division_id = newProject.division_id;
}, { immediate: true });

const updateProject = () => {
    openModal.value = true;
};

const closeModal = () => {
    openModal.value = false;
    form.title = props.projects.title || '';
    form.status = props.projects.status || '';
    form.division_id = newProject.division_id;
}

const editproject = () => {
    form.put(route('projects.update', props.projects.id), {
        onSuccess: () => {
            closeModal(),
            toast.success('Project updated Successfully')
        },
        onError: () => {
            toast.warning('Failed to update Project')
        }
    });
}

</script>

<template>
    <PrimaryButton @click="updateProject" class="bg-blue-700 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-900"><i class="fa fa-edit text-white-500 text-sm"></i></PrimaryButton>

    <section>
        <SmallerModal :show="openModal" @close="closeModal">
            <!-- Head -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl">
                    Edit project {{ projects.title }}
                </h3>
                <button type="button" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" @click="closeModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Body -->
            <div class="flex items-center justify-center m-10">
                <form @submit.prevent="editproject">
                    <div class="space-y-4">
                        <div>
                            <InputLabel for="title" value="Project Title"/>
                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                placeholder="project"
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
                            <InputLabel for="status" value="Status"/>
                            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="status" v-model="form.status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="flex justify-center items-center">
                            <PrimaryButton
                                :disabled="form.processing"
                                type="submit"
                            >
                                Update project
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </SmallerModal>
    </section>
</template>
