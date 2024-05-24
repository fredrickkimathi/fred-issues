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
                style="background-image: url('https://static.vecteezy.com/system/resources/previews/038/261/741/non_2x/ai-generated-a-grunge-pale-sage-green-background-elegantly-distressed-for-a-touch-of-vintage-charm-free-photo.jpg');" >
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
            class=" items-center p-4 pt-20 rounded justify-center sm:flex-row sm:justify-start sm:items-start sm:space-x-4 sm:space-y-0 space-y-4 text-emerald-900"
        >
        <p class="font-bold p-2 underline text-center text-lg">Welcome to our issues tracking website</p>

                <div class="py-12 ">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-green-100 bg-opacity-65 overflow-hidden shadow-sm sm:rounded-lg py-10">
                            <div class="p-6 text-gray-900 text-center font-bold">ISSUE TRACKING SYSTEM</div>
                            <div class="p-6 text-gray-600 text-center">Welcome to our Cytonn Issue Tracking Website, your go-to platform for reporting, tracking, and resolving issues across multiple Cytonn websites. Whether you are a developer, a tester, or a user, our comprehensive system is designed to streamline the process of issue management, ensuring efficient communication and timely resolution.</div>
                        </div>

                        <div class="flex flex-row space-x-4">
                            <div class="flex-1 bg-purple-200 bg-opacity-55 overflow-hidden shadow-sm sm:rounded-lg mt-10">
                                <div class="p-6 text-gray-900 text-center font-bold">Key Features</div>
                                <ul class="text-gray-800 mt-4 list-disc list-inside pl-10"> 
                                    <li>Multi-Website Issue Reporting</li>
                                    <li>Real-Time Notifications</li>
                                    <li>Comprehensive Analytics</li>
                                    <li>User-Friendly Interface</li>
                                </ul>
                            </div>

                            <div class="flex-1 bg-blue-200 bg-opacity-55 overflow-hidden shadow-sm sm:rounded-lg mt-10">
                                <div class="p-6 text-gray-900 text-center font-bold">Reporting an Issue</div>
                                <div class="p-6 text-gray-600 text-center">To report an issue, Please login or Register if you do not have an account, after login, press on 'REPORT ISSUE' on the navigation bar. You will be redirected to a page where you can report the issue you have experienced from any of our Cytonn websites. Select the system you experienced the issue from and a screenshot of the issue. The Admin will check on it and have it resolved as soon as possible. </div>
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
