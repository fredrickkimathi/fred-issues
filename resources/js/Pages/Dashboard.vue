<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Placeholder data
const metrics = {
  totalIssues: 120,
  openIssues: 45,
  closedIssues: 60,
  inProgressIssues: 15
};

const recentActivity = [
  { id: 1, text: 'Issue #101: Updated 10 minutes ago' },
  { id: 2, text: 'Issue #102: Closed 1 hour ago' },
  { id: 3, text: 'Issue #103: Commented 3 hours ago' }
];

const searchQuery = ref('');
const filters = ref({
  status: 'All',
  priority: 'All'
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
              <div class="text-3xl font-bold">{{ metrics.totalIssues }}</div>
              <div class="text-gray-600">Total Issues</div>
            </div>
            <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold">{{ metrics.openIssues }}</div>
              <div class="text-gray-600">Open Issues</div>
            </div>
            <div class="bg-yellow-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold">{{ metrics.closedIssues }}</div>
              <div class="text-gray-600">Closed Issues</div>
            </div>
            <div class="bg-red-100 p-6 rounded-lg shadow text-center">
              <div class="text-3xl font-bold">{{ metrics.inProgressIssues }}</div>
              <div class="text-gray-600">In Progress Issues</div>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
          <ul class="space-y-4">
            <li v-for="activity in recentActivity" :key="activity.id" class="bg-gray-100 p-4 rounded-lg shadow">
              {{ activity.text }}
            </li>
          </ul>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
          <h3 class="text-lg font-medium text-gray-900 mb-4">Search and Filters</h3>
          <div class="flex flex-col space-y-4">
            <input v-model="searchQuery" placeholder="Search issues" class="p-2 border border-gray-300 rounded-lg" />
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-gray-600 mb-1">Status</label>
                <select v-model="filters.status" class="p-2 border border-gray-300 rounded-lg w-full">
                  <option>All</option>
                  <option>Open</option>
                  <option>In Progress</option>
                  <option>Resolved</option>
                </select>
              </div>
              <div>
                <label class="block text-gray-600 mb-1">Priority</label>
                <select v-model="filters.priority" class="p-2 border border-gray-300 rounded-lg w-full">
                  <option>All</option>
                  <option>Critical</option>
                  <option>High</option>
                  <option>Medium</option>
                  <option>Low</option>
                </select>
              </div>
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
