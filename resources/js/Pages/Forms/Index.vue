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
      <div class="row" style="margin:5px;">
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
            <div class="min-h-96 max-h-min">
                    <table class="table-auto w-full">
                        <thead class="border-b-2 border-black">
                            <tr>
                                <th class="px-4 pb-2">Document Reference Code</th>
                                <th class="px-4 pb-2">Document Title</th>
                                <th class="px-4 pb-2">Revision Number</th>
                                <th class="px-4 pb-2">Effectivity Date</th>
                                <th class="px-4 pb-2">Owner</th>
                                <th class="px-4 pb-2">Type</th>
                                <th class="px-4 pb-2">Status</th>
                                <th class="px-4 pb-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="form in filteredForms" :key="form.id" class="border-b hover:bg-gray-100 even:bg-gray-50">
                                <td class="px-4">{{ form.doc_ref_code }}</td>
                                <td class="px-4">{{ form.doc_title }}</td>
                                <td class="px-4">{{ form.revision_num }}</td>
                                <td class="px-4">{{ form.effectivity_date }}</td>
                                <td class="px-4">{{ form.owner }}</td>
                                <td class="px-4">{{ form.doc_type }}</td>
                                <td class="px-4">{{ form.status }}</td>
                                <td>
                                <div class="flex space-x-1">
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

