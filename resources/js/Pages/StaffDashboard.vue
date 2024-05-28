<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const totalIssues = ref(0);
const myIssues = ref(0);
const {props} = usePage();
const currentUserID = props.auth.user.id;
console.log(currentUserID);

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

const fetchMyIssues = async () => {
  try {
    const response = await axios.get(`/api/displaymyissues/${currentUserID}`);
    myIssues.value = response.data.length;
    console.log(myIssues.value);
    
  } catch (error) {
    console.error('Error fetching my issues:', error);
  }
};

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
            <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold"></div>
              <div class="text-3xl font-bold">{{ myIssues }}</div>
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
