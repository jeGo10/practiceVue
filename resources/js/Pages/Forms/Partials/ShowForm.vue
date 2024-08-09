<script setup>
import ShowButton from '@/Components/ShowButton.vue';
import BiggerModal from '@/Components/BiggerModal.vue';
import DisplayLabel from '@/Components/DisplayLabel.vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  form: Object,
});

const showingForm = ref(false);
const pdfUrl = ref('');

const showForm = async () => {
    showingForm.value = true;
    // Display embedded file from storage/app/public/documents
    try {
        const response = await axios.get(`/forms/${props.form.id}/pdf`, { responseType: 'blob' });
        const blob = new Blob([response.data], { type: 'application/pdf' });
        pdfUrl.value = URL.createObjectURL(blob);
    } catch (error) {
        console.error('Error fetching PDF:', error);
    }
};

const closeModal = () => {
    showingForm.value = false;
    // Revoke the object URL to free up memory
    URL.revokeObjectURL(pdfUrl.value);
    pdfUrl.value = '';
};
</script>

<template>
    <div>
        <ShowButton @click="showForm">
            <i class="text-sm fa fa-eye"></i>
        </ShowButton>

        <section>
            <BiggerModal :show="showingForm" @close="closeModal">
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
                        <span>{{ props.form.owner }}</span>
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

                <!-- PDF Embed Section -->
                <div class="p-4" v-if="pdfUrl">
                    <embed :src="pdfUrl" type="application/pdf" width="100%" height="600px" />
                </div>
                <div v-else class="p-4">
                    <i class="fa fa-circle-o-notch mr-2"></i>Loading PDF...
                </div>
            </BiggerModal>
        </section>
    </div>
</template>
