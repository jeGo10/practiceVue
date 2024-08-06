<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateForm from './Partials/CreateForm.vue';
import EditForm from './Partials/EditForm.vue';
import DeleteForm from './Partials/DeleteForm.vue';
import ShowForm from './Partials/ShowForm.vue';
import { Head } from '@inertiajs/vue3';

// Define props for forms and divisions
const props = defineProps({
  forms: Array,
  projects: { type: Array, default: () => [] },
  divisions: { type: Array, default: () => [] },
  auth: { type: Object, default: () => ({ user: { role: '' } }) }
});

// State for search query
const searchQuery = ref('');
// Role checker
const isAdmin = computed(() => props.auth.user?.roles.some(role => role.name === 'admin'));

// Computed property for filtered forms
const filteredForms = computed(() => {
  return props.forms.filter(form => {
    return (
      form.doc_ref_code.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      form.doc_title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      form.owner.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      form.doc_type.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      form.status.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  });
});
</script>


<template>
    <Head title="Forms"/>
    <AuthenticatedLayout>
      <div class="row" style="margin:20px;">
        <div class="col-12">
          <div class="card">
            <div class="text-center alert alert-dark" style="margin-left: 20px; margin-right: 20px; margin-top: 20px; background-color: #0693e3; color: #ffffff;">
              <h2>Forms</h2>
            </div>
            <div class="text-center alert alert-light">
              <div style="display: flex; align-items: center; justify-content: center; margin: 20px;">
                <input v-model="searchQuery" class="form-control me-2" type="text" placeholder="Search" name="search" style="flex: 1;">
                <button class="btn btn-primary" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
              </div>

              <div style="display: flex; align-items: center; justify-content: space-between; margin-right: 20px; margin-left: 20px;">
                <div>
                  <span><strong>IMPORTANT:</strong> Only the softcopy of documents available on the QMS portal is considered the <strong>CONTROLLED COPY.</strong></span><br>
                  <span>Any downloaded or printed copies of documents are deemed <strong>UNCONTROLLED</strong>.</span>
                </div>
              </div>
              <div v-if="isAdmin" style="margin: 20px; text-align: left;">
                <CreateForm :divisions="divisions" :projects="projects"/>
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
                  <tr v-for="form in filteredForms" :key="form.id">
                    <td>{{ form.doc_ref_code }}</td>
                    <td>{{ form.doc_title }}</td>
                    <td>{{ form.revision_num }}</td>
                    <td>{{ form.effectivity_date }}</td>
                    <td>{{ form.owner }}</td>
                    <td>{{ form.doc_type }}</td>
                    <td>{{ form.status }}</td>
                    <td>
                      <div class="flex space-x-2">
                        <ShowForm :form="form"/>
                        <EditForm v-if="isAdmin" :form="form" />
                        <DeleteForm v-if="isAdmin" :form="form" />
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

