<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateForm from './Partials/CreateForm.vue';
import EditForm from './Partials/EditForm.vue';
import DeleteForm from './Partials/DeleteForm.vue';
import ShowForm from './Partials/ShowForm.vue';
import {Head} from '@inertiajs/vue3';

// Define props for forms and divisions
const props = defineProps({
  forms: Array,
  divisions: Array,
});
</script>

<template>
    <Head title="Forms"/>
    <AuthenticatedLayout>
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="text-center alert alert-dark"
                        style="margin-left: 20px; margin-right: 20px; margin-top: 20px; background-color: #0693e3; color: #ffffff;">
                        <h2>Forms</h2>
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
                        <div style="margin: 20px; text-align: left;">
                            <CreateForm :divisions="divisions"/>
                        </div>
                    </div>

                    <!-- Table for Displaying Files -->
                    <div class="table-responsive min-h-96">
                        <table class="table max-w-full">
                            <thead class="border-b-2 border-black">
                                <tr>
                                    <th>Document Reference Code</th>
                                    <th>Document Title</th>
                                    <th>Revision Number</th>
                                    <th>Effectivity Date</th>
                                    <th>Owner</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="form in forms" :key="form.id">
                                    <td>{{ form.doc_ref_code }}</td>
                                    <td>{{ form.doc_title }}</td>
                                    <td>{{ form.revision_num }}</td>
                                    <td>{{ form.effectivity_date }}</td>
                                    <td>{{ form.process_owner }}</td>
                                    <td>{{ form.doc_type }}</td>
                                    <td>{{ form.status }}</td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <!-- EditForm and DeleteForm components -->
                                            <ShowForm :form="form"/>
                                            <EditForm :form="form" />
                                            <DeleteForm :form="form" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
