<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateForm from './Partials/CreateForm.vue';

const props = defineProps(['data']);
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
                        <div class="alert alert-light text-center">
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
                                <CreateForm/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </AuthenticatedLayout>
</template>
