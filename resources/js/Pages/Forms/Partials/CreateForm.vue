<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import BiggerModal from '@/Components/BiggerModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useToast } from 'vue-toastification';

// State for managing modal visibility
const creatingDocument = ref(false);
const toast = useToast();
const props = defineProps({
    divisions: Array,
    projects: Array,
});

// Initialize form with useForm
const form = useForm({
    doc_ref_code: '',
    doc_title: '',
    division: '',
    project: '',
    owner: '',
    status: 'Active',
    doc_type: '',
    request_type: '',
    request_reason: '',
    request_date: '',
    revision_num: '0',
    effectivity_date: '',
    file: null,
    type: '',
});

// Function to show the modal
const showModal = () => {
    creatingDocument.value = true;
};

// Function to close the modal
const closeModal = () => {
    creatingDocument.value = false;
};

// Function to submit the form
const submit = () => {
    form.post(route('forms.store'), {
        onSuccess: () => {
            form.reset(),
            closeModal(),
            toast.success('Form added Successfully')
        },
        onError: () => {
            toast.warning('Failed to add Form')
        }
    });
};
</script>

<template>
    <div>
        <!-- Button to trigger modal -->
        <PrimaryButton @click="showModal"><i class="fa fa-plus mr-2"></i>Create New Document</PrimaryButton>

        <!-- Modal for creating new document -->
        <BiggerModal :show="creatingDocument" @close="closeModal">
            <!-- Modal Head -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl">Create New Document</h3>
                <button
                    type="button"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-900 rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto"
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
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="space-y-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <InputLabel for="doc_ref_code" value="Doc Ref. Code"/>
                                <TextInput
                                    id="doc_ref_code"
                                    v-model="form.doc_ref_code"
                                    type="text"
                                    placeholder="Enter Document Reference Code"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="doc_title" value="Document Title"/>
                                <TextInput
                                    id="doc_title"
                                    v-model="form.doc_title"
                                    type="text"
                                    placeholder="Enter Document Title"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="division" value="Division"/>
                                <select
                                    id="division"
                                    v-model="form.division"
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    <option value="" disabled>Select Division</option>
                                    <option v-for="division in divisions" :key="division.id" :value="division.name">
                                        {{ division.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <InputLabel for="project" value="Project/Unit"/>
                                <select
                                    id="project"
                                    v-model="form.project"
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    <option value="" disabled>Select Project</option>
                                    <option v-for="project in projects" :key="project.id" :value="project.title">
                                        {{ project.title }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <InputLabel for="owner" value="Owner"/>
                                <TextInput
                                    id="owner"
                                    v-model="form.owner"
                                    type="text"
                                    placeholder="Enter Owner"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="doc_type" value="Document Type"/>
                                <select
                                    id="doc_type"
                                    v-model="form.doc_type"
                                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    <option value="" disabled>Select Document Type</option>
                                    <option value="Quality Manual">Quality Manual</option>
                                    <option value="Quality Procedure">Quality Procedure</option>
                                    <option value="Quality Procedure Form">Quality Procedure Form</option>
                                    <option value="Quality Policy">Quality Policy</option>
                                    <option value="Operations Manual">Operations Manual</option>
                                    <option value="Procedure Manual">Procedure Manual</option>
                                    <option value="Special Order">Special Order</option>
                                    <option value="Travel Order">Travel Order</option>
                                    <option value="Memorandum">Memorandum</option>
                                    <option value="Corrective Action Request Form">Corrective Action Request Form</option>
                                    <option value="Form/Template">Form/Template</option>
                                    <option value="Resolution">Resolution</option>
                                </select>
                            </div>
                            <div>
                                <InputLabel for="request_type" value="Request Type"/>
                                <select
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    id="request_type"
                                    v-model="form.request_type"
                                    required
                                >
                                    <option value="" disabled>Select Request Type</option>
                                    <option value="Creation">Creation</option>
                                    <option value="Revision">Revision</option>
                                    <option value="Deletion">Deletion</option>
                                </select>
                            </div>
                            <div>
                                <InputLabel for="request_reason" value="Request Reason"/>
                                <TextInput
                                    id="request_reason"
                                    v-model="form.request_reason"
                                    type="text"
                                    placeholder="Enter Request Reason"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="request_date" value="Request Date"/>
                                <TextInput
                                    id="request_date"
                                    v-model="form.request_date"
                                    type="date"
                                    placeholder="Enter Request Date"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="status" value="Status"/>
                                <TextInput
                                    id="status"
                                    v-model="form.status"
                                    type="text"
                                    placeholder="Enter Status"
                                    class="bg-gray-100"
                                    disabled
                                />
                            </div>
                            <div>
                                <InputLabel for="revision_num" value="Revision Number"/>
                                <TextInput
                                    id="revision_num"
                                    v-model="form.revision_num"
                                    type="text"
                                    placeholder="Enter Revision Number"
                                    class="bg-gray-100"
                                    disabled
                                />
                            </div>
                            <div>
                                <InputLabel for="effectivity_date" value="Effectivity Date"/>
                                <TextInput
                                    id="effectivity_date"
                                    v-model="form.effectivity_date"
                                    type="date"
                                    placeholder="Enter Effectivity Date"
                                    required
                                />
                            </div>
                            <div>
                                <InputLabel for="type" value="Type"/>
                                <select
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    id="type"
                                    v-model="form.type"
                                    required
                                >
                                    <option value="" disabled>Select Type</option>
                                    <option value="Active">Internal</option>
                                    <option value="Inactive">External</option>
                                </select>
                            </div>
                            <div class="col-span-3">
                                <InputLabel for="file" value="File"/>
                                <input
                                    id="file"
                                    type="file"
                                    class="border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    @change="e => form.file = e.target.files[0]"
                                    required
                                />
                            </div>
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <PrimaryButton :disabled="form.processing">
                                Save Document
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </BiggerModal>
    </div>
</template>
