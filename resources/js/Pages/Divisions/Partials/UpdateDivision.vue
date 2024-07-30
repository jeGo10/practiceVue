<script setup>
import SmallerModal from '@/Components/SmallerModal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const editingDivision = ref(false);
const props = defineProps(['divisions']);

const form = useForm({
    name: props.divisions.name || '',
    description: props.divisions.description || '',
    status: props.divisions.status || false,
});

watch(() => props.divisions, (newDivision) => {
    form.name = newDivision.name;
    form.status = newDivision.status;
}, { immediate: true });

const updateDivision = () => {
    editingDivision.value = true;
};

const closeModal = () => {
    editingDivision.value = false;
    form.name = props.divisions.name || '';
    form.status = props.divisions.status || '';
}

const editDivision = () => {
    form.put(route('divisions.update', props.divisions.id), {
        onSuccess: () => closeModal(),
    });
}

</script>

<template>
    <PrimaryButton @click="updateDivision" class="bg-blue-700 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-900"><i class="fa fa-edit text-white-500 text-sm"></i></PrimaryButton>

    <section>
        <SmallerModal :show="editingDivision" @close="closeModal">
            <!-- Head -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-xl">
                    Edit Division {{ divisions.name }}
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
                <form @submit.prevent="editDivision">
                    <div class="space-y-4">
                        <div>
                            <InputLabel for="name" value="Division"/>
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                placeholder="Division"
                                required
                            />
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
                                Update Division
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </SmallerModal>
    </section>
</template>
