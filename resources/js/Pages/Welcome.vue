<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-cover bg-gray-100  dark:bg-gray-800 selection:bg-red-500 selection:text-white"
                style="background-image: url('https://www.cxtoday.com/wp-content/uploads/2021/05/Issue-Tracker.png');" >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-bold text-white hover:text-gray-900 dark:white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-cyan-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="font-bold text-white pl-5 hover:text-gray-900 dark:white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-cyan-500"
                    >Register</Link
                >
            </template>
        </div>
        <div
            class=" items-center border-2 border-cyan-500 p-4 rounded justify-center sm:flex-row sm:justify-start sm:items-start sm:space-x-4 sm:space-y-0 space-y-4 text-white"
        >
        <p class="font-bold p-2 underline text-center text-lg">Welcome to our issues tracker website</p>

        <p class="text-center pt-10 pb-10">Cytonn Technologies has multiple systems for use by internal and external users e.g., CRIMS, CySuites Website, CyTravel e.t.c. This website's function is to enhance operations and customer service by enabling users to report any issues from the Cytonn websites. This tracking system that can be used to streamline the management and resolution of user-reported issues for its various systems. </p>
        <p class="text-center pt-10">Please LOGIN or REGISTER from the top right section to use this website</p>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
