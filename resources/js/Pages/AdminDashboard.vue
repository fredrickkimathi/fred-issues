<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

// Reactive data
const totalIssues = ref(0); // Initialize totalIssues as 0
const allIssues = ref([]); // Initialize allIssues as an empty array
const currentPage = ref(1); // Current page number
const issuesPerPage = 5; // Number of issues per page
const showAllIssues = ref(false); // Boolean flag to track the visibility of the All Issues section

const searchQuery = ref('');
const filters = ref({
  status: 'All',
  priority: 'All'
});

// Fetch total issues from the API
const fetchTotalIssues = async () => {
  try {
    const response = await axios.get('/api/displayissues');
    totalIssues.value = response.data; // Set the totalIssues value from the API response
  } catch (error) {
    console.error('Error fetching total issues:', error);
  }
};

const fetchAllIssues = async () => {
  try {
    const response = await axios.get(`/api/allissues?page=${currentPage.value}&perPage=${issuesPerPage}`);
    allIssues.value = response.data; // Set allIssues value from the API response
    console.log(response.data);
    // Call nextPage function to fetch the next page if on the first page
    if (currentPage.value === 1) {
      nextPage();
    }
  } catch (error) {
    console.error('Error fetching all issues:', error);
  }
};

onMounted(() => {
  fetchTotalIssues();
  fetchAllIssues();
});

// Computed property to calculate the total number of pages
const totalPages = computed(() => Math.ceil(totalIssues.value / issuesPerPage));

// Function to navigate to the next page
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
    fetchAllIssues();
  }
};

// Function to navigate to the previous page
const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
    fetchAllIssues();
  }
};

// Toggle function to show/hide the All Issues section
const toggleAllIssues = () => {
  showAllIssues.value = !showAllIssues.value;
};
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
            <!-- Add similar blocks for other metrics -->
          </div>
        </div>

        <!-- All Issues -->
        <div v-if="showAllIssues" class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">All Issues</h3>
          <ul class="space-y-4">
            <li v-for="issue in allIssues" :key="issue.id" class="bg-gray-100 p-4 rounded-lg shadow">
              Name: {{ issue.name }} <br> Description: {{ issue.description }} <br> System: {{ issue.system_id }}
            </li>
          </ul>
          <div class="flex justify-between mt-4">
            <button @click="prevPage" :disabled="currentPage === 1" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Previous</button>
            <span>Page {{ currentPage }} of {{ totalPages }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Next</button>
          </div>
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
