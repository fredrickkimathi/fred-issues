<script setup>
import { ref, onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';

const UserData = ref([]);

const form = useForm({
    task_name: '',
    task_description: '',
    user: '',
    priority: '',
    supporting_doc: null,
});

onMounted(() => {
    fetchUser();
});

const handleFileChange = (event) => {
    form.supporting_doc = event.target.files[0];
};

const submit = () => {
    let formData = new FormData();
    formData.append('task_name', form.task_name);
    formData.append('task_description', form.task_description);
    formData.append('user', form.user);
    formData.append('priority', form.priority);
    if (form.supporting_doc) {
        formData.append('supporting_doc', form.supporting_doc);
    }

    form.post(route('tasks.store'), {
        data: formData,
        onFinish: () => form.reset()
    });
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
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Report Issue" />

        <div class="bg-white m-10 rounded-lg p-10">
            <p class="text-center pb-5 font-bold underline">Assign A Task</p>

            <form @submit.prevent="submit" class="max-w-md mx-auto">
                <!-- Name of Task -->
                <div class="mb-6">
                    <InputLabel for="task_name" value="Name of Task" />
                    <TextInput
                        id="task_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.task_name"
                        required
                        autofocus
                        autocomplete="task_name"
                    />
                    <InputError class="mt-2" :message="form.errors.task_name" />
                </div>

                <!-- Select user -->
                <div class="mb-6">
                    <InputLabel for="user" value="Assign to" />
                    <select id="user" name="user" class="form-select mt-1 block w-full" v-model="form.user">
                        <option disabled value="">Assign to</option>
                        <option v-for="user in UserData" :value="user.id" :key="user.id">{{ user.name }} {{ user.last_name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.user" />
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
