<!-- resources/js/Pages/Archive/Index.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps(['archives']);
</script>

<template>
    <AuthenticatedLayout>

        <div class="row" style="margin:20px;">
            <div class="col-12">

                <div class="card">
                    <div class="text-center alert alert-dark"
                        style="margin-left: 20px; margin-right: 20px; margin-top: 20px; background-color: #0693e3; color: #ffffff;">
                        <h2>Archive</h2>
                    </div>
                    <div class="text-center alert alert-light">
                        <div style="display: flex; align-items: center; justify-content: center; margin: 20px;">
                            <input class="form-control me-2" type="text" placeholder="Search" name="search" style="flex: 1;">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; margin-right: 20px; margin-left: 20px;">
                            <div>
                                <span><strong>IMPORTANT:</strong> Only the softcopy of documents available on the QMS portal is considered the <strong>CONTROLLED COPY.</strong></span><br>
                                <span>Any downloaded or printed copies of documents are deemed <strong>UNCONTROLLED</strong>.</span>
                            </div>
                        </div>
                    </div>
                      <!-------------------------------------------TABLE FOR DISPLAYED FILE --------------------------------------------------- -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Document Reference Code</th>
                                        <th>Document Title</th>
                                        <th>Revision Number</th>
                                        <th>Effectivity Date</th>
                                        <th>Owner </th>
                                        <th>Type</th>
                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="archive in props.archives" :key="archive.id">
                                        <td>{{ archive.doc_ref_code }}</td>
                                        <td>{{ archive.doc_title}}</td>
                                        <td>{{ archive.revision_num }}</td>
                                        <td>{{ archive.effectivity_date }}</td>
                                        <td>{{ archive.process_owner }}</td>
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
