<script setup>
import { ref,onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';


const UserData = ref( []);
const form = useForm({
    task_name: '',
    task_description: '',
    user: '',
    priority: '',
    supporting_doc: null,
});

onMounted(()=>{
   fetchUser(); 
   fetchPriority();
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
// tasks fetched
const fetchtask = async()=>{
    const response = await axios.get('#');
    TaskData.value = response.data;
    console.log(response.data);


}
const fetchUser = async()=>{
    const response = await axios.get(' http://fred-issues2.test/api/users');
    UserData.value = response.data;
    console.log(response.data);


}

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
                        v-model="form.issue_name"
                        required
                        autofocus
                        autocomplete="task_name"
                    />
                    <InputError class="mt-2" :message="form.errors.task_name" />
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <InputLabel for="task_description" value="Description" />
                    <TextInput
                        id="task_description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.task_description"
                        required
                        autocomplete="task_description"
                    />
                    <InputError class="mt-2" :message="form.errors.task_description" />
                </div>

                <!-- Select user -->
                <div class="mb-6">
                    <InputLabel for="user" value="Assign to" />
                    <select id="user" name="user" class="form-select mt-1 block w-full" v-model="form.user">
                        <option disabled value="">Assign to</option>
                        <option v-for="user in UserData" :value="user.id" :key="user.id">{{ user.name }} {{user.last_name}}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.user" />
                </div>

                <!-- Select Issue Type -->
                <div class="mb-6">
                    <InputLabel for="priority" value="Priority of Issue" />
                    <select id="priority" name="priority" class="form-select mt-1 block w-full" v-model="form.priority">
                        <option disabled value="">Select Priority</option>
                        <option v-for="priority in PriorityData" :value="priority.id" :key="priority.id">{{ priority.name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.priority" />
                </div>

                <!-- Issue Screenshot -->
                <div class="mb-6">
                    <InputLabel for="supporting_doc" value="Issue Screenshot" />
                    <input
                        id="supporting_doc"
                        type="file"
                        class="mt-1 block w-full"
                        @change="handleFileChange"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.supporting_doc" />
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
