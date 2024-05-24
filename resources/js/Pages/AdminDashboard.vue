<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <div class="dashboard">
    <h1>Admin Dashboard</h1>
    <div class="overview-metrics">
      <div class="metric">Total Issues: {{ metrics.totalIssues }}</div>
      <div class="metric">Open Issues: {{ metrics.openIssues }}</div>
      <div class="metric">Closed Issues: {{ metrics.closedIssues }}</div>
      <div class="metric">Issues In Progress: {{ metrics.issuesInProgress }}</div>
    </div>

    <div class="system-health">
      <h2>System Health</h2>
      <div class="chart">[Issue Creation Rate: Line Chart]</div>
      <div class="chart">[Issue Resolution Rate: Line Chart]</div>
      <div class="chart">[Open vs. Closed Issues: Trend Comparison]</div>
    </div>

    <div class="workload-distribution">
      <h2>Workload Distribution</h2>
      <div class="chart">[By Assignee: Bar Chart]</div>
      <div class="chart">[By Team/Department: Pie Chart]</div>
    </div>

    <div class="kpis">
      <h2>Key Performance Indicators (KPIs)</h2>
      <div class="metric">Average Resolution Time: {{ kpis.avgResolutionTime }}</div>
      <div class="metric">Average Response Time: {{ kpis.avgResponseTime }}</div>
      <div class="metric">Escalated Issues: {{ kpis.escalatedIssues }}</div>
    </div>

    <div class="critical-alerts">
      <h2>Critical Alerts</h2>
      <ul>
        <li v-for="alert in criticalAlerts" :key="alert.id">
          {{ alert.text }}
        </li>
      </ul>
    </div>

    <div class="search-filters">
      <input v-model="searchQuery" placeholder="Search issues" />
      <div class="filters">
        <label>
          Status:
          <select v-model="filters.status">
            <option>All</option>
            <option>Open</option>
            <option>In Progress</option>
            <option>Resolved</option>
          </select>
        </label>
        <label>
          Priority:
          <select v-model="filters.priority">
            <option>All</option>
            <option>Critical</option>
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
          </select>
        </label>
        <label>
          Assignee:
          <select v-model="filters.assignee">
            <option>All</option>
            <!-- List of assignees -->
          </select>
        </label>
        <label>
          Date Range:
          <input type="date" v-model="filters.startDate" />
          <input type="date" v-model="filters.endDate" />
        </label>
      </div>
    </div>

    <div class="recent-activity">
      <h2>Recent Activity</h2>
      <ul>
        <li v-for="activity in recentActivity" :key="activity.id">
          {{ activity.text }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      metrics: {
        totalIssues: 100,
        openIssues: 40,
        closedIssues: 50,
        issuesInProgress: 10
      },
      kpis: {
        avgResolutionTime: '3 days',
        avgResponseTime: '1 day',
        escalatedIssues: 5
      },
      criticalAlerts: [
        { id: 1, text: 'High-Priority Issue #789: Requires immediate attention' },
        { id: 2, text: 'Issue #012: Overdue by 1 day' }
      ],
      recentActivity: [
        { id: 1, text: 'Issue #123: Created 1 hour ago' },
        { id: 2, text: 'Issue #456: Updated 2 hours ago' }
      ],
      searchQuery: '',
      filters: {
        status: 'All',
        priority: 'All',
        assignee: 'All',
        startDate: '',
        endDate: ''
      }
    };
  }
};
</script>

