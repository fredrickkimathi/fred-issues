<script setup>
import { ref, onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';

const UserData = ref([]);
const IssuesData = ref([]);

const form = useForm({
    issue_id: '',
    user_id: '',
});

onMounted(() => {
    fetchUser();
    fetchIssues();
});

const submit = async () => {
    try {
        await axios.post('http://fred-issues2.test/api/assignment', {
            issue_id: form.issue_id,
            user_id: form.user_id,
        });
        form.reset();
    } catch (error) {
        console.error('Error assigning task:', error);
    }
};

const fetchUser = async () => {
    try {
        const response = await axios.get('http://fred-issues2.test/api/users');
        // Filter users with role_id 2
        UserData.value = response.data.filter(user => user.role_id === 2);
        console.log(UserData.value);
    } catch (error) {
        console.error('Error fetching users:', error);
    }
};

const fetchIssues = async () => {
    try {
        const response = await axios.get('http://fred-issues2.test/api/issues');
        // Filter issues with status_id 1
        IssuesData.value = response.data.filter(issue => issue.status_id === 1);
        console.log(IssuesData.value);
    } catch (error) {
        console.error('Error fetching issues:', error);
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Assign Task" />

        <div class="bg-white m-10 rounded-lg p-10">
            <p class="text-center pb-5 font-bold underline">Assign A Task</p>

            <form @submit.prevent="submit" class="max-w-md mx-auto">
                <!-- Select Task Name -->
                <div class="mb-6">
                    <InputLabel for="issue_id" value="Name of Task" />
                    <select id="issue_id" name="issue_id" class="form-select mt-1 block w-full" v-model="form.issue_id">
                        <option disabled value="">Select Task</option>
                        <option v-for="issue in IssuesData" :value="issue.id" :key="issue.id">{{ issue.name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.issue_id" />
                </div>

                <!-- Select user -->
                <div class="mb-6">
                    <InputLabel for="user_id" value="Assign to" />
                    <select id="user_id" name="user_id" class="form-select mt-1 block w-full" v-model="form.user_id">
                        <option disabled value="">Assign to</option>
                        <option v-for="user in UserData" :value="user.id" :key="user.id">{{ user.name }} {{ user.last_name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.user_id" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end">
                    <PrimaryButton class="px-4 py-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Assign
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
