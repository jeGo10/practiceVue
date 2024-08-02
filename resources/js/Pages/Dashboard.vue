<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

// Define reactive state for active tab
const activeTab = ref('visionmission');

// Define reactive state for active tab

// Function to change active tab
const changeTab = (tabName) => {
  activeTab.value = tabName;
}
</script>

<template>
    <div>
      <Head title="Dashboard" />

      <AuthenticatedLayout>
        <div class="document-background max-w-none">
          <div class="card-body container max-w-lg">
            <!-- Tabs for navigation -->
            <ul class="nav nav-tabs rounded-t-lg" id="myTab" role="tablist">
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

            <!-- Vision & Mission Tab -->
            <div v-if="activeTab === 'visionmission'" class="tab-pane fade show active">
              <h1 class="entry-title text-center mb-8 pt-2.5"><strong>Mission and Vision</strong></h1>

              <div class="flex justify-between items-center mb-8">
                <div class="flex-1 text-center">
                  <img src="/images/mission.png" alt="Mission Image" class="image mx-auto" style="width: 100px; height: auto;">
                </div>
                <div class="flex-1 text-center">
                  <img src="/images/vision.png" alt="Vision Eye Image" class="image mx-auto" style="width: 100px; height: auto;">
                </div>
                <div class="flex-1 text-center">
                  <img src="/images/core-value.png" alt="Core Value Image" class="image mx-auto" style="width: 100px; height: auto;">
                </div>
              </div>

              <div class="flex justify-between items-start gap-8">
                <div class="flex-1 max-w-md ml-10">
                  <div class="content-box p-4">
                    <h2 class="text-center font-bold mb-2">Mission</h2>
                    <p class="italic text-center mb-4">DICT of the people and for the people.</p>
                    <p class="text-center mb-4">The Department of Information and Communications Technology commits to:</p>
                    <ul class="list-disc pl-8 text-justify">
                      <li>Provide every Filipino access to vital ICT infrastructure and services</li>
                      <li>Ensure sustainable growth of Philippine ICT-enabled industries resulting in the creation of more jobs</li>
                      <li>Establish a One Digitized Government, One Nation</li>
                      <li>Support the administration in fully achieving its goals</li>
                      <li>Be the enabler, innovator, achiever, and leader in pushing the country's development and transition towards a world-class digital economy</li>
                    </ul>
                  </div>
                </div>

                <div class="flex-1 max-w-md">
                  <div class="content-box p-4">
                    <h2 class="text-center font-bold mb-2">Vision</h2>
                    <p class="text-justify mb-4">An innovative, safe, and happy nation that thrives through and is enabled by Information and Communications Technology.</p>
                    <p class="text-justify">DICT aspires for the Philippines to develop and flourish through innovation and constant development of ICT in the pursuit of a progressive, safe, secured, contented, and happy Filipino nation.</p>
                  </div>
                </div>

                <div class="flex-1 max-w-md mr-10">
                  <div class="core-values bg-slate-100 rounded-lg shadow-md p-4">
                    <h4 class="font-bold mb-2">Core Values</h4>
                    <ul class="list-none pl-0">
                      <li>D – Dignity</li>
                      <li>I – Integrity</li>
                      <li>C – Competency and Compassion</li>
                      <li>T – Transparency</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quality Policy Tab -->
            <div v-if="activeTab === 'qualitypolicy'" class="tab-pane fade show">
              <div class="">
                <div class=" m-3 p-2">
                  <h1 class="entry-title text-center pb-1 "><strong>Quality Policy</strong></h1>
                  <p class="text-center"><i>QPL/r0/01Feb24</i></p>
                  <div class="">
                    <p><strong>The Department of Information and Communications Technology RIX BASULTA commits to:</strong></p>
                    <ul>
                      <li>Lead in pushing the National ICT Development agenda in transitioning the Philippines toward a world-class digital economy.</li>
                      <li>Endeavor to support the achievement of national development goals through innovation and provision of quality and secure information and communications technology (ICT) products and services compliant with pertinent regulatory and statutory requirements and international standards.</li>
                      <li>Adhere to the continual improvement of its Quality Management System by maintaining highly competent and committed public servants and by delivering quality services that exceed the expectations of its stakeholders.</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quality Objectives Tab -->
            <div v-if="activeTab === 'qualityobjectives'" class="tab-pane fade show">
              <div class="p-3">
                <div class="p-3">
                  <h1 class="entry-title text-center"><strong>Quality Objectives</strong></h1>
                  <p class="entry-title text-center"><i>QP-01/r0/01Feb24</i></p>

                  <ol class="text-justify">
                    <li class="mb-2 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To deliver the required ICT products and services according to mutually agreed terms and conditions and existing applicable statutory and regulatory requirements.</span>
                    </li>
                    <li class="mb-2 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To ensure the effective implementation, compliance, and continuous improvement of the Quality Management System in order to meet customer requirements.</span>
                    </li>
                    <li class="mb-2 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To monitor and evaluate adherence to the agency's Key Performance Indicators (KPI) on quality, efficiency, and timeliness.</span>
                    </li>
                  </ol>
                  <h3 class="entry-title text-center"><strong>ADMINISTRATIVE AND FINANCE DIVISION (AFD) QUALITY OBJECTIVES</strong></h3>
                  <p class="entry-title text-center"><i>QO-02/r2/18Jun24</i></p>
                  <ol class="text-justify">
                    <li class="mb-4 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To ensure that all Human Resource Systems are in place in terms of Recruitment, Selection, and Placement; Learning and Development; Performance Management; and Rewards and Recognition with 100% compliance to the Civil Service Commission's Program to Institutionalize Meritocracy and Excellence in Human Resource Management (PRIME-HRM).</span>
                    </li>
                    <li class="mb-4 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To ensure efficient and effective financial management, disbursements, monitoring, and reporting of all statutory/regulatory and legal requirement of government monitoring agencies thru accurate and timely preparation, verification, certification, and submission of financial statements and reports to include monthly, quarterly, and annual Financial Statements and other related reports shall be done in the prescribed deadlines.</span>
                    </li>
                    <li class="mb-4 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To ensure timely preparation and submission of annual budget of the Regional Office are accurate and accomplished within the prescribed period set by the DICT Central Office, the Department of Budget and Management (DBM), and other concerned government agencies. To monitor budget utilization rate at 90%.</span>
                    </li>
                    <li class="mb-4 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To maintain complete inventory of property, plant, and equipment (PPE) and efficient process of provision of supply in the office and equipment to property custodians.</span>
                    </li>
                    <li class="mb-4 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To maintain 90% of the buildings and facilities as well as the 100% of the official vehicles in good condition to provide personnel conducive workspaces and ensure safe travels respectively.</span>
                    </li>
                    <li class="mb-4 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">Ensure 100% accuracy and traceability of incoming and outgoing documents, achieve full compliance with statutory and regulatory requirements for document retention and disposal, and guarantee delivery of documents to the designated division or unit within 24 hours of receipt.</span>
                    </li>
                    <li class="mb-4 flex">
                      <span class="mr-2">✅</span>
                      <span class="text-justify">To attain at least a very satisfactory customer satisfaction rating from 80% of customers surveyed.</span>
                    </li>
                  </ol>
                </div>
              </div>
            </div>

            <!-- Contact Us Tab -->
            <div v-if="activeTab === 'contactus'" class="tab-pane fade show">
              <div class="container mx-auto mt-4" style="max-width: 1500px;">
                <img src="/images/DMT-Members.jpg" alt="Image" style="display: block; width: 100%; height: auto;">
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
  background-color: #ffffff; /* Light gray background */
  border: 1px solid #f4f6f7; /* Gray border */
  border-radius: 10px; /* Rounded corners */
  box-shadow: 0 2px 4px rgba(255, 255, 255, 0.932); /* Drop shadow for depth */
}
.card-body{
    display: block;
    border: 2px solid #1E293B;
    background-color: #ffffffb7;
    border-radius: 10px;
  box-shadow: 0 2px 4px rgba(255, 255, 255, 0.932);
}
.card-border{
    background-color: white;
}
.image {
  width: 25%    ;
  height: auto;
}
.text {
  font-family: Arial, Helvetica, sans-serif
}

.nav {
    background-color: #1E293B;
    color: #f4f6f7;
}
.nav-link {
    color: #f4f6f7;
}

.image-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  .image {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
  }

  .content-box {
    background-color: #ffffff;
    /* border: 1px solid #f4f6f7;
    border-radius: 10px; */
    box-shadow: 0 2px 4px rgba(255, 255, 255, 0.932);
    padding: 20px;
    margin-bottom: 20px;
  }

  .core-values {
    align-self: flex-end;
    background-color: #ffffff; /* Tailwind Slate-100 */
    padding: 20px;
    /* border: 1px solid #f4f6f7;
    border-radius: 10px; */
    box-shadow: 0 2px 4px rgba(255, 255, 255, 0.932);
  }
</style>
