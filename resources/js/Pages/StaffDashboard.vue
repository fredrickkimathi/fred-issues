<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

// Reactive data
const ReportedIssueData = ref([]);

onMounted(async() => {
     await fetchReportedIssue();
});

const fetchReportedIssue = async () => {
    const response = await axios.get('/api/displayissues');
    ReportedIssueData.value = response.data;
    console.log(response.data);
};


const totalIssues = ref();


const searchQuery = ref('');
const filters = ref({
  status: 'All',
  priority: 'All'
});

// Fetch total issues from the API
const fetchTotalIssues = async () => {
  try {
    const input=  await axios.get('/api/displayissues');
    totalIssues.value = input.data;
    console.log(totalIssues.value);
  } catch (error) {
    console.error('Error fetching total issues:', error);
  }
};

onMounted(() => {
  fetchTotalIssues();
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
            <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold"></div>
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

        

      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
/* Custom styles if needed */
</style>
