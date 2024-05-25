<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

// Reactive data
const totalIssues = ref(0);
const assignedIssues = ref(0);
const allIssues = ref([]);
const assignedIssuesData = ref([]);
const currentPage = ref(1);
const issuesPerPage = 5;
const showAllIssues = ref(false);
const showAssignedIssues = ref(false);
const priorities = ref([]);

// Fetch all issues from the server
const fetchAllIssues = async () => {
  try {
    const response = await axios.get(`/api/allissues?page=${currentPage.value}&perPage=${issuesPerPage}`);
    // Filter issues with status_id equal to 1
    const filteredIssues = response.data.filter(issue => issue.status_id === 1);
    // Set the totalIssues value to the length of the filteredIssues array
    totalIssues.value = filteredIssues.length;
    // Set allIssues to filteredIssues
    allIssues.value = filteredIssues;
    if (currentPage.value === 1) nextPage();
  } catch (error) {
    console.error('Error fetching all issues:', error);
  }
};

// Fetch priorities from the server
const fetchPriorities = async () => {
  try {
    const response = await axios.get('/api/priorities');
    priorities.value = response.data;
  } catch (error) {
    console.error('Error fetching priorities:', error);
  }
};

// Fetch assigned issues from the server
const fetchAssignedIssues = async () => {
  try {
    const response = await axios.get('/api/assignment');
    assignedIssues.value = response.data.length;
    assignedIssuesData.value = response.data;
  } catch (error) {
    console.error('Error fetching assigned issues:', error);
  }
};

// Update the priority of the issue
const setPriority = async (issueId, priorityId) => {
  try {
    await axios.put(`/api/issues/${issueId}/priority`, { priorityId });
    // After updating priority, fetch all issues again
    fetchAllIssues();
  } catch (error) {
    console.error('Error setting priority:', error);
  }
};

// Calculate total pages for pagination
const totalPages = computed(() => Math.ceil(totalIssues.value / issuesPerPage));

// Go to the next page
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
    fetchAllIssues();
  }
};

// Go to the previous page
const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
    fetchAllIssues();
  }
};

// Toggle visibility of all issues section
const toggleAllIssues = () => {
  showAllIssues.value = !showAllIssues.value;
};

// Toggle visibility of assigned issues section
const toggleAssignedIssues = () => {
  showAssignedIssues.value = !showAssignedIssues.value;
};

// Fetch data when the component is mounted
onMounted(() => {
  fetchAllIssues();
  fetchPriorities();
  fetchAssignedIssues();
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

        <!-- Overview Metrics -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Overview Metrics</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-green-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold" @click="toggleAllIssues" style="cursor: pointer">{{ totalIssues }}</div>
              <div class="text-gray-600">Total Issues</div>
            </div>
            <div class="bg-orange-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold" @click="toggleAssignedIssues" style="cursor: pointer">{{ assignedIssues }}</div>
              <div class="text-gray-600">Assigned Issues</div>
            </div>
          </div>
        </div>

        <!-- All Issues -->
        <div v-if="showAllIssues" class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">All Issues</h3>
          <ul class="space-y-4">
            <li v-for="issue in allIssues" :key="issue.id" class="bg-gray-100 p-4 rounded-lg shadow">
              Name: {{ issue.name }} <br> 
              Description: {{ issue.description }} <br> 
              System: {{ issue.system_id }}
              <div class="mt-2">
                <label for="priority" class="block text-sm font-medium text-gray-700">Select Priority:</label>
                <select v-model="issue.selectedPriority" id="priority" name="priority" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                  <option v-for="priority in priorities" :key="priority.id" :value="priority.id">{{ priority.name }}</option>
                </select>
                <button @click="setPriority(issue.id, issue.selectedPriority)" class="mt-2 px-4 py-2 bg-indigo-500 text-white rounded-lg">Set</button>
              </div>
            </li>
          </ul>
          <div class="flex justify-between mt-4">
            <button @click="prevPage" :disabled="currentPage === 1" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Previous</button>
            <span>Page {{ currentPage }} of {{ totalPages }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Next</button>
          </div>
        </div>

        <!-- Assigned Issues -->
        <div v-if="showAssignedIssues" class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Assigned Issues</h3>
          <ul class="space-y-4">
            <li v-for="issue in assignedIssuesData" :key="issue.issue_name" class="bg-gray-100 p-4 rounded-lg shadow">
              <strong>Issue Name:</strong> {{ issue.issue_name }} <br> 
              <strong>Issue Description:</strong> {{ issue.issue_description }} <br>
              <strong>System Name: </strong>{{ issue.system_name }} <br>
              <strong>Assigned To:</strong> {{ issue.assigned_user }}
            </li>
          </ul>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Search and Filters</h3>
          <!-- Your search and filter components -->
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
/* Custom styles if needed */
</style>
