<script setup>
import { ref, watch } from 'vue';
import BiggerModal from '@/Components/BiggerModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const props = defineProps(['form']);
const editingForm = ref(false);
const toast = useToast();

const form = useForm({
  doc_title: props.form.doc_title || '',
  request_type: props.form.request_type || '',
  request_reason: props.form.request_reason || '',
  revision_num: props.form.revision_num || '',
  effectivity_date: props.form.effectivity_date || '',
  owner: props.form.owner || '',
  doc_type: props.form.doc_type || '',
  status: props.form.status || '',
});

watch(() => props.form, (newForm) => {
  form.doc_title = newForm.doc_title;
  form.request_type = newForm.request_type;
  form.request_reason = newForm.request_reason;
  form.revision_num = newForm.revision_num;
  form.effectivity_date = newForm.effectivity_date;
  form.owner = newForm.owner;
  form.doc_type = newForm.doc_type;
  form.status = newForm.status;
}, { immediate: true });

const updateForm = () => {
  editingForm.value = true;
};

const closeModal = () => {
  editingForm.value = false;
  form.doc_title = props.form.doc_title || '';
  form.revision_num = props.form.revision_num || '';
  form.effectivity_date = props.form.effectivity_date || '';
  form.owner = props.form.owner || '';
  form.doc_type = props.form.doc_type || '';
  form.status = props.form.status || '';
};

const editForm = () => {
  // Increment the revision number before updating the form
  form.revision_num = (parseInt(form.revision_num, 10) + 1).toString();

  form.put(route('forms.update', props.form.id), {
    onSuccess: () => {
      closeModal();
      toast.success('Form updated successfully');
    },
    onError: () => {
      toast.warning('Failed to update form');
    }
  });
};
</script>

<template>
    <div>
        <PrimaryButton @click="updateForm">
            <i class="text-sm fa fa-edit text-white-500"></i>
        </PrimaryButton>

        <section>
            <BiggerModal :show="editingForm" @close="closeModal">
                <!-- Head -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl">
                        Edit Form {{ form.doc_title }}
                    </h3>
                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-900 rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" @click="closeModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="flex items-center justify-center m-10">
                    <form @submit.prevent="editForm" class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <InputLabel for="doc_title" value="Document Title"/>
                            <TextInput
                                id="doc_title"
                                v-model="form.doc_title"
                                type="text"
                                placeholder="Document Title"
                                required
                            />
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
                            <InputLabel for="revision_num" value="Revision Number"/>
                            <TextInput
                                id="revision_num"
                                v-model="form.revision_num"
                                type="number"
                                placeholder="Revision Number"
                                disabled
                                class="bg-gray-100"
                            />
                        </div>
                        <div>
                            <InputLabel for="effectivity_date" value="Effectivity Date"/>
                            <TextInput
                                id="effectivity_date"
                                v-model="form.effectivity_date"
                                type="date"
                                placeholder="Effectivity Date"
                                required
                            />
                        </div>
                        <div>
                            <InputLabel for="owner" value="Owner"/>
                            <TextInput
                                id="owner"
                                v-model="form.owner"
                                type="text"
                                placeholder="Owner"
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
                            <InputLabel for="status" value="Status"/>
                            <select
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                id="status"
                                v-model="form.status"
                                required
                            >
                                <option value="" disabled>Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-center sm:col-span-3">
                            <PrimaryButton :disabled="form.processing" type="submit">
                                Update Form
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </BiggerModal>
        </section>
    </div>
</template>
