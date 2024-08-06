<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps(['archives']);

const searchQuery = ref('');

const filteredArchives = computed(() => {
    if (searchQuery.value === '') {
        return props.archives;
    }
    return props.archives.filter(archive =>
        archive.doc_ref_code.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        archive.doc_title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        archive.revision_num.toString().includes(searchQuery.value) ||
        archive.effectivity_date.includes(searchQuery.value) ||
        archive.owner.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        archive.type.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        archive.status.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="text-center alert alert-dark" style="margin: 20px; background-color: #0693e3; color: #ffffff;">
                        <h2>Archive</h2>
                    </div>
                    <div class="text-center alert alert-light">
                        <div style="display: flex; align-items: center; justify-content: center; margin: 20px;">
                            <input v-model="searchQuery" class="form-control me-2" type="text" placeholder="Search" style="flex: 1;">
                            <button class="btn btn-primary" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin: 20px;">
                            <div>
                                <span><strong>IMPORTANT:</strong> Only the softcopy of documents available on the QMS portal is considered the <strong>CONTROLLED COPY.</strong></span><br>
                                <span>Any downloaded or printed copies of documents are deemed <strong>UNCONTROLLED</strong>.</span>
                            </div>
                        </div>
                    </div>
                    <!-------------------------------------------TABLE FOR DISPLAYED FILE --------------------------------------------------- -->
                    <div class="table-responsive min-h-96">
                        <table class="table">
                            <thead class="border-b-2 border-black">
                                <tr>
                                    <th>Document Reference Code</th>
                                    <th>Document Title</th>
                                    <th>Revision Number</th>
                                    <th>Effectivity Date</th>
                                    <th>Owner</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="archive in filteredArchives" :key="archive.id">
                                    <td>{{ archive.doc_ref_code }}</td>
                                    <td>{{ archive.doc_title }}</td>
                                    <td>{{ archive.revision_num }}</td>
                                    <td>{{ archive.effectivity_date }}</td>
                                    <td>{{ archive.owner }}</td>
                                    <td>{{ archive.doc_type }}</td>
                                    <td>{{ archive.status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
