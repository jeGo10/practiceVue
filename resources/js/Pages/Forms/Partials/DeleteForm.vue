<script setup>
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const props = defineProps(['form']);
const deletingForm = ref(false);
const toast = useToast();

const form = useForm({
  doc_ref_code: props.form.doc_ref_code,
  doc_title: props.form.doc_title,
  revision_num: props.form.revision_num,
  effectivity_date: props.form.effectivity_date,
  process_owner: props.form.process_owner,
  doc_type: props.form.doc_type,
  status: 'Inactive',
});

const deleteForm = () => {
  deletingForm.value = true;
};

const closeModal = () => {
  deletingForm.value = false;
};

const destroyForm = () => {
  form.delete(route('forms.destroy', props.form.id), {
    onSuccess: () => {
            closeModal(),
            toast.success('Form deleted Successfully')
        },
        onError: () => {
            toast.warning('Failed to delete Form')
        }
  });
};
</script>

<template>
  <div>
    <DangerButton @click="deleteForm"><i class="text-sm fa fa-trash-o"></i></DangerButton>
    <section>
      <Modal :show="deletingForm" @close="closeModal">
        <!-- Head -->
        <div class="flex items-center justify-between p-4 border-b rounded-t">
          <h3 class="text-xl">
            Delete Form {{ form.doc_title }}?
          </h3>
          <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-900 rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" @click="closeModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>

        <!-- Body -->
        <div class="flex items-center justify-start m-10">
          <h1 class="text-xl">
            Are you sure you want to delete {{ form.doc_title }}?
          </h1>
        </div>
        <div class="flex justify-end m-4">
          <form @submit.prevent="destroyForm">
            <DangerButton>Delete</DangerButton>
          </form>
        </div>
      </Modal>
    </section>
  </div>
</template>
