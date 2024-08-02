<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

const props = defineProps(['form']);
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
        <PrimaryButton @click="showForm" class="bg-blue-600 hover:bg-blue-800"><i class="text-sm fa fa-eye"></i></PrimaryButton>

        <section>
            <Modal :show="showingForm" @close="closeModal">
                <!-- Head -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl">
                        Showing Form {{ form.doc_title }}
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

                </div>
            </Modal>
        </section>
    </div>
</template>
