<script setup>
import { ref, watch } from 'vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const props = defineProps(['form']);
const editingForm = ref(false);
const toast = useToast();

const form = useForm({
  doc_ref_code: props.form.doc_ref_code || '',
  doc_title: props.form.doc_title || '',
  revision_num: props.form.revision_num || '',
  effectivity_date: props.form.effectivity_date || '',
  process_owner: props.form.process_owner || '',
  doc_type: props.form.doc_type || '',
  status: props.form.status || '',
});

watch(() => props.form, (newForm) => {
  form.doc_ref_code = newForm.doc_ref_code;
  form.doc_title = newForm.doc_title;
  form.revision_num = newForm.revision_num;
  form.effectivity_date = newForm.effectivity_date;
  form.process_owner = newForm.process_owner;
  form.doc_type = newForm.doc_type;
  form.status = newForm.status;
}, { immediate: true });

const updateForm = () => {
  editingForm.value = true;
};

const closeModal = () => {
  editingForm.value = false;
  form.doc_ref_code = props.form.doc_ref_code || '';
  form.doc_title = props.form.doc_title || '';
  form.revision_num = props.form.revision_num || '';
  form.effectivity_date = props.form.effectivity_date || '';
  form.process_owner = props.form.process_owner || '';
  form.doc_type = props.form.doc_type || '';
  form.status = props.form.status || '';
};

const editForm = () => {
  form.put(route('forms.update', props.form.id), {
    onSuccess: () => {
            closeModal(),
            toast.success('Form updated Successfully')
        },
        onError: () => {
            toast.warning('Failed to update Form')
        }
  });
};
</script>

<template>
    <div>
        <PrimaryButton @click="updateForm" class="bg-blue-700 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-900">
            <i class="text-sm fa fa-edit text-white-500"></i>
        </PrimaryButton>

        <section>
            <Modal :show="editingForm" @close="closeModal">
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
                            <InputLabel for="doc_ref_code" value="Document Reference Code"/>
                            <TextInput
                                id="doc_ref_code"
                                v-model="form.doc_ref_code"
                                type="text"
                                placeholder="Document Reference Code"
                                required
                            />
                        </div>
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
                            <InputLabel for="revision_num" value="Revision Number"/>
                            <TextInput
                                id="revision_num"
                                v-model="form.revision_num"
                                type="text"
                                placeholder="Revision Number"
                                required
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
                            <InputLabel for="process_owner" value="Process Owner"/>
                            <TextInput
                                id="process_owner"
                                v-model="form.process_owner"
                                type="text"
                                placeholder="Process Owner"
                                required
                            />
                        </div>
                        <div>
                            <InputLabel for="doc_type" value="Document Type"/>
                            <TextInput
                                id="doc_type"
                                v-model="form.doc_type"
                                type="text"
                                placeholder="Document Type"
                                required
                            />
                        </div>
                        <div>
                            <InputLabel for="status" value="Status"/>
                            <TextInput
                                id="status"
                                v-model="form.status"
                                type="text"
                                placeholder="Status"
                                required
                            />
                        </div>
                        <div class="flex items-center justify-center sm:col-span-3">
                            <PrimaryButton :disabled="form.processing" type="submit">
                                Update Form
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </Modal>
        </section>
    </div>
    </template>
