<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="AdminDashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">ISSUE TRACKER - Admin Dashboard </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center font-bold">WELCOME TO OUR ISSUE TRACKING SYSTEM</div>
                    <div class="p-6 text-gray-400 text-center">To report any issue from our websites, please fill in the form below</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
