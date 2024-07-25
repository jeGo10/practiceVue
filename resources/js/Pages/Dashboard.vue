<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Define reactive state for active tab
const activeTab = ref('visionmission');

// Function to change active tab
const changeTab = (tabName) => {
  activeTab.value = tabName;
}
</script>

<template>
    <div>
      <Head title="Dashboard" />

      <AuthenticatedLayout>


        <div class="document-background">
          <div class=" card-body container" style="background-color: white; padding: 0;">

            <!-- Tabs for navigation -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link" :class="{ 'active': activeTab === 'visionmission' }" @click="changeTab('visionmission')">Vision & Mission</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" :class="{ 'active': activeTab === 'qualitypolicy' }" @click="changeTab('qualitypolicy')">Quality Policy</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" :class="{ 'active': activeTab === 'qualityobjectives' }" @click="changeTab('qualityobjectives')">Quality Objectives</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" :class="{ 'active': activeTab === 'contactus' }" @click="changeTab('contactus')">Contact Us</button>
              </li>
            </ul>


            <!-- Tab content -->
            <div class="tab-content" id="myTabContent">
              <!-- Vision & Mission Tab -->
              <div v-if="activeTab === 'visionmission'" class="tab-pane fade show active">
                <div class=" ">
                  <h1 class="entry-title text-center"><strong>Mission and Vision</strong></h1>
                  <br><br>

                  <div class="flex justify-center items-center gap-1">
                  <div class="image">
                    <img src="/images/mission.png" alt="">
                  </div>
                  <div class="standing-rectangle p-6">
                    <div class="text">
                      <p><strong>Mission</strong></p>
                      <i>DICT of the people and for the people.</i>
                      <p>The Department of Information and Communications Technology commits to:</p>
                      <ul>
                        <li>• Provide every Filipino access to vital ICT infrastructure and services</li>
                        <li>• Ensure sustainable growth of Philippine ICT-enabled industries resulting in the creation of more jobs</li>
                        <li>• Establish a One Digitized Government, One Nation</li>
                        <li>• Support the administration in fully achieving its goals</li>
                        <li>• Be the enabler, innovator, achiever, and leader in pushing the country’s development and transition towards a world-class digital economy</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <br>
                <br>
                <br>
                <div class="flex mx-1 mt-8">
                    <div class="flex-1 px-3 mb-6 ml-10 py-2 h-48 shadow-md bg-slate-40 shadow-cyan-500 rounded-lg">
                        <div>
                            <p class="font-bold">Vision</p>
                            <p>An innovative, safe, and happy nation that thrives through and is enabled by Information and Communications Technology.</p>
                            <p>DICT aspires for the Philippines to develop and flourish through innovation and constant development of ICT in the pursuit of a progressive, safe, secured, contented, and happy Filipino nation.</p>
                        </div>
                    </div>
                    <img src="/images/vision.png" alt="Image" class="h-56 -mt-5 mx-40 ml-44 object-cover">
                </div>

                </div>
              </div>

              <!-- Quality Policy Tab -->
              <div v-if="activeTab === 'qualitypolicy'" class="tab-pane fade show active">
                  <div class="">
                    <div class="container mx-auto mt-4" style="max-width: 1500px;">
                      <div class="card border rounded-lg shadow-lg">
                        <br>
                        <div class="card-header items-center p-1 bg-gray-100">
                          <h3 class="entry-title text-center mb-2"><strong>Quality Policy</strong></h3>
                          <p class="entry-title text-center mb-3"><i>QPL/r0/01Feb24</i></p>

                          <!-- Quality Policy Content -->
                          <div>
                            <p></p>
                          </div>
                        </div>

                        <!-- Commitments Section -->
                        <div class="p-4">
                          <p><strong>The Department of Information and Communications Technology RIX BASULTA commits to:</strong></p>

                          <ul class="list-disc pl-8">
                            <li>Lead in pushing the National ICT Development agenda in transitioning the Philippines toward a world-class digital economy.</li>
                            <br>
                            <li>Endeavor to support the achievement of national development goals through innovation and provision of quality and secure information and communications technology (ICT) products and services compliant with pertinent regulatory and statutory requirements and international standards.</li>
                            <br>
                            <li>Adhere to the continual improvement of its Quality Management System by maintaining highly competent and committed public servants and by delivering quality services that exceed the expectations of its stakeholders.</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>






              <!-- Quality Objectives Tab -->
              <div v-if="activeTab === 'qualityobjectives'" class="tab-pane fade show active">
                <div class="">
                  <div class="container mx-auto mt-4" style="max-width: 1500px;">
                      <div class="card border rounded-lg shadow-lg">
                        <br>
                        <h3 class="entry-title text-center"><strong>Quality Objectives</strong></h3>
                        <p class="entry-title text-center"><i>QP-01/r0/01Feb24</i></p>
                        <div class="card-header items-center p-1 bg-gray-100"></div>
                  <br>
                  <ol>
                    <li>To deliver the required ICT products and services according to mutually agreed terms and conditions and existing applicable statutory and regulatory requirements;</li>
                    <li>To ensure the effective implementation, compliance, and continuous improvement of the Quality Management System in order to meet customer requirements;</li>
                    <li>To monitor and evaluate adherence to the agency's Key Performance Indicators (KPI) on quality, efficiency, and timeliness.</li>
                  </ol>
                      </div>
                  </div>
                  <br>
                  <br>

                  <div class="container mx-auto mt-4" style="max-width: 1500px;">
                      <div class="card border rounded-lg shadow-lg">
                        <br>
                        <h3 class="entry-title text-center"><strong>ADMINISTRATIVE AND FINANCE DIVISION (AFD) QUALITY OBJECTIVES</strong></h3>
                        <p class="entry-title text-center"><i>QO-02/r2/18Jun24</i></p>
                        <div class="card-header items-center p-1 bg-gray-100"></div>

                  <ol>
                    <br>
                    <li>To ensure that all Human Resource Systems are in place in terms of Recruitment, Selection, and Placement; Learning and Development; Performance Management; and Rewards and Recognition with 100% compliance to the Civil Service Commission’s Program to Institutionalize Meritocracy and Excellence in Human Resource Management (PRIME-HRM);</li>
                    <li>To ensure efficient and effective financial management, disbursements, monitoring, and reporting of all statutory/regulatory and legal requirement of government monitoring agencies thru accurate and timely preparation, verification, certification, and submission of financial statements and reports to include monthly, quarterly, and annual Financial Statements and other related reports shall be done in the prescribed deadlines.</li>
                    <li>To ensure timely preparation and submission of annual budget of the Regional Office are accurate and accomplished within the prescribed period set by the DICT Central Office, the Department of Budget and Management (DBM), and other concerned government agencies. To monitor budget utilization rate at 90%.</li>
                    <li>To maintain complete inventory of property, plant, and equipment (PPE) and efficient process of provision of supply in the office and equipment to property custodians.</li>
                    <li>To maintain 90% of the buildings and facilities as well as the 100% of the official vehicles in good condition to provide personnel conducive workspaces and ensure safe travels respectively.</li>
                    <li>Ensure 100% accuracy and traceability of incoming and outgoing documents, achieve full compliance with statutory and regulatory requirements for document retention and disposal, and guarantee delivery of documents to the designated division or unit within 24 hours of receipt.</li>
                    <li>To attain at least a very satisfactory customer satisfaction rating from 80% of customers surveyed.</li>
                  </ol>
                      </div>
                  </div>

                </div>
              </div>

              <!-- Contact Us Tab -->
              <div v-if="activeTab === 'contactus'" class="tab-pane fade show active">
                <div class="container mx-auto mt-4" style="max-width: 1500px;">
                      <div class="card border rounded-lg shadow-lg">
                <div class="card-body" style="padding-top: 100px;"> <!-- Adjust padding-top as needed -->
                  <img src="/images/DMT-Members.jpg" alt="Image"
                  style="display: block; width: 100%; height: auto;">
                  <div class="card-header items-center p-1 bg-gray-100"></div>
                  <br>

                  <h3 class="entry-title text-center"><strong>Contact Us</strong></h3>
                  <p class="text-center">
                    <i class="fa fa-phone" aria-hidden="true" style="margin-right: 5px;"></i>(062) 991 2742<br>
                    <i class="fa fa-envelope-o" aria-hidden="true" style="margin-right: 5px;"></i>region9basulta@dict.gov.ph<br>
                    <i class="fa fa-globe" aria-hidden="true" style="margin-right: 5px;"></i>www.dict.gov.ph<br>
                    <i class="fa fa-facebook-official" aria-hidden="true" style="margin-right: 5px;"></i>@DICT.RO9BASULTA<br>
                  </p>
                </div>
                </div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </AuthenticatedLayout>
    </div>
  </template>



<style scoped>
.standing-rectangle {
  padding: 15px;
  margin-left: 50px;
  margin-right: 50px;
  width: 3000px; /* Adjust width as needed */
  height: 310px; /* Adjust height as needed */
  background-color: #ffffffb7; /* Light gray background */
  border: 1px solid #f4f6f7; /* Gray border */
  border-radius: 10px; /* Rounded corners */
  box-shadow: 0 2px 4px rgba(14, 167, 214, 0.932); /* Drop shadow for depth */
}
.card-body{
    border: 1px solid #f4f6f7;
    background-color: #ffffffb7;
    border-radius: 10px;
  box-shadow: 0 2px 4px rgba(14, 167, 214, 0.932);
}
.image {
  width: 60%;
  height: auto;
}
.text {
  font-family: Arial, Helvetica, sans-serif
}

</style>
