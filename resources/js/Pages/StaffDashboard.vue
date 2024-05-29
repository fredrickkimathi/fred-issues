<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const totalIssues = ref(0);
const myIssuesCount = ref(0);
const myAssignedIssues = ref([]);
const showMyAssignedIssues = ref(false);
const { props } = usePage();
const currentUserID = props.auth.user.id;

console.log(currentUserID);

// Fetch total issues from the API
const fetchTotalIssues = async () => {
  try {
    const input = await axios.get('/api/displayissues');
    totalIssues.value = input.data;
    console.log(totalIssues.value);
  } catch (error) {
    console.error('Error fetching total issues:', error);
  }
};

// Fetch my assigned issues from the API
const fetchMyIssues = async () => {
  try {
    const response = await axios.get(`/api/displaymyissues/${currentUserID}`);
    myIssuesCount.value = response.data.length;
    myAssignedIssues.value = response.data;
    console.log(myAssignedIssues.value); // Log the data to debug
  } catch (error) {
    console.error('Error fetching my issues:', error);
  }
};

// Toggle visibility of my assigned issues section
const toggleMyAssignedIssues = () => {
  showMyAssignedIssues.value = !showMyAssignedIssues.value;
};

// Method to handle "Will Work on It" button click
const handleWillWorkOnIt = async (issueId) => {
  try {
    const response = await axios.post(`/api/issue/${issueId}/workonit`);
    console.log('Will work on it response:', response.data);
    fetchMyIssues(); // Refresh the issues list
  } catch (error) {
    console.error('Error handling will work on it:', error);
  }
};

// Method to handle "Reassign" button click
const handleReassign = async (issueId) => {
  try {
    const response = await axios.post(`/api/issue/${issueId}/reassign`);
    console.log('Reassign response:', response.data);
    fetchMyIssues(); // Refresh the issues list
  } catch (error) {
    console.error('Error handling reassign:', error);
  }
};

// Fetch data when the component is mounted
onMounted(() => {
  fetchTotalIssues();
  fetchMyIssues();
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Staff Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

        <!-- Overview Metrics -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Overview Metrics</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-green-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold">{{ totalIssues }}</div>
              <div class="text-gray-600">All Issues</div>
            </div>
            <div class="bg-blue-100 p-6 rounded-lg shadow text-center" @click="toggleMyAssignedIssues" style="cursor: pointer">
              <div class="text-3xl font-bold">{{ myIssuesCount }}</div>
              <div class="text-gray-600">My Assigned Issues</div>
            </div>
            <div class="bg-yellow-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold"></div>
              <div class="text-gray-600">Closed Issues</div>
            </div>
            <div class="bg-red-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold"></div>
              <div class="text-gray-600">In Progress Issues</div>
            </div>
          </div>
        </div>

        <!-- My Assigned Issues -->
        <div v-if="showMyAssignedIssues" class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">My Assigned Issues</h3>
          <ul class="space-y-4">
            <li v-for="issue in myAssignedIssues" :key="issue.id" class="bg-gray-100 p-4 rounded-lg shadow">
              <strong>Issue Name:</strong> {{ issue.issue_name }} <br> 
              <strong>Issue Description:</strong> {{ issue.issue_description }} <br>
              <strong>System Name:</strong> {{ issue.system_name }} <br>
              <button @click="handleWillWorkOnIt(issue.id)" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Will Work on It</button>
              <button @click="handleReassign(issue.id)" class="bg-red-500 text-white px-4 py-2 rounded mt-2 ml-10">Reassign</button>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
/* Custom styles if needed */
</style>
