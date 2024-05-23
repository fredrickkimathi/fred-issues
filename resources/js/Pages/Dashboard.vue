<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">ISSUE TRACKER</h2>
        </template>

        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-100 bg-opacity-95 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center font-bold">ISSUE TRACKING SYSTEM</div>
                    <div class="p-6 text-gray-400 text-center">Welcome to our Cytonn Issue Tracking Website, your go-to platform for reporting, tracking, and resolving issues across multiple Cytonn websites. Whether you are a developer, a tester, or a user, our comprehensive system is designed to streamline the process of issue management, ensuring efficient communication and timely resolution.</div>
                </div>

                <div class="flex flex-row space-x-4">
                    <div class="flex-1 bg-pink-200 bg-opacity-95 overflow-hidden shadow-sm sm:rounded-lg mt-10">
                        <div class="p-6 text-gray-900 text-center font-bold">Key Features</div>
                        <ul class="text-gray-500 mt-4 list-disc list-inside pl-10"> 
                            <li>Multi-Website Issue Reporting</li>
                            <li>Real-Time Notifications</li>
                            <li>Comprehensive Analytics</li>
                            <li>User-Friendly Interface</li>
                        </ul>
                    </div>

                    <div class="flex-1 bg-blue-200 bg-opacity-95 overflow-hidden shadow-sm sm:rounded-lg mt-10">
                        <div class="p-6 text-gray-900 text-center font-bold">Reporting an Issue</div>
                        <div class="p-6 text-gray-400 text-center">To report an issue, press on 'REPORT ISSUE' on the navigation bar. You will be redirected to a page where you can report the issue you have experienced from any of our Cytonn websites. Select the system you experienced the issue from and a screenshot of the issue. The Admin will check on it and have it resolved as soon as possible. </div>
                        <!-- <div class="flex flex-col pt-10 text-center">
                            <div>
                            <p>KEY FEATURES</p>
                            <li>
                            Multi-Website Issue Reporting
                            </li>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
