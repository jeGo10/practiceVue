<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import DisplayLabel from '@/Components/DisplayLabel.vue';
import { ref } from 'vue';

const props = defineProps({
  form: Object,
});

const showingForm = ref(false);

const showForm = () => {
    showingForm.value = true;
}

const closeModal = () => {
    showingForm.value = false;
}
</script>

<template>
    <div>
        <PrimaryButton @click="showForm" class="bg-sky-600 hover:bg-sky-800">
            <i class="text-sm fa fa-eye"></i>
        </PrimaryButton>

        <section>
            <Modal :show="showingForm" @close="closeModal">
                <!-- Head -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl">
                        View form {{ props.form.doc_title }} details.
                    </h3>
                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-900 rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" @click="closeModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-4 grid grid-cols-2 gap-0.5 min-h-96">
                    <!-- First Column -->
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Document Reference Code:'" class="mr-2"/>
                        <span>{{ props.form.doc_ref_code }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Document Title:'" class="mr-2"/>
                        <span>{{ props.form.doc_title }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Division:'" class="mr-2"/>
                        <span>{{ props.form.division }}</span>
                    </div>

                    <!-- Second Column -->
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Process Owner:'" class="mr-2"/>
                        <span>{{ props.form.process_owner }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Status:'" class="mr-2"/>
                        <span>{{ props.form.status }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Document Type:'" class="mr-2"/>
                        <span>{{ props.form.doc_type }}</span>
                    </div>

                    <!-- Third Column -->
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Request Type:'" class="mr-2"/>
                        <span>{{ props.form.request_type }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Request Reason:'" class="mr-2"/>
                        <span>{{ props.form.request_reason }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Requester:'" class="mr-2"/>
                        <span>{{ props.form.requester }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Request Date:'" class="mr-2"/>
                        <span>{{ props.form.request_date }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Revision Number:'" class="mr-2"/>
                        <span>{{ props.form.revision_num }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <DisplayLabel :value="'Effectivity Date:'" class="mr-2"/>
                        <span>{{ props.form.effectivity_date }}</span>
                    </div>
                </div>
            </Modal>
        </section>
    </div>
</template>
