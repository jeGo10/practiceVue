<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateForm from './Partials/CreateForm.vue';

// Define reactive properties
const selectedType = ref(''); // Default to an empty value or a specific type if needed

// Example options for the select input
const documentTypes = [
    { value: '', label: 'All Types' },
    { value: 'Internal', label: 'Internal' },
    { value: 'External', label: 'External' },
];
</script>

<template>
    <AuthenticatedLayout>
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="alert alert-dark text-center"
                        style="margin-left: 20px; margin-right: 20px; margin-top: 20px; background-color: #0693e3; color: #ffffff;">
                        <h2>Forms</h2>
                    </div>

                    <!-- Search and Filter Form -->
                    <div class="alert alert-light text-center">
                        <form action="/your-endpoint" method="GET" class="d-flex">
                            <input class="form-control me-2" type="text" placeholder="Search" name="search">
                            <select v-model="selectedType" name="type" class="form-select"
                                style="width: auto; min-width: 120px; margin-right: 5px;">
                                <option v-for="option in documentTypes" :key="option.value" :value="option.value">
                                    {{ option.label }}
                                </option>
                            </select>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>

                        <!-- Information Notice -->
                        <div style="display: flex; align-items: center; justify-content: space-between; margin: 40px 20px 20px;">
                            <div>
                                <span><strong>IMPORTANT:</strong> Only the softcopy of documents available on the QMS portal is considered the <strong>CONTROLLED COPY.</strong></span><br>
                                <span>Any downloaded or printed copies of documents are deemed <strong>UNCONTROLLED</strong>.</span>
                            </div>
                        </div>

                        <div style="margin: 20px; text-align: left;">
                            <CreateForm/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
