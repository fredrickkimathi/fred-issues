<script setup>
import { ref,onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';

const IssueData = ref( []);
const SystemData = ref( []);
const form = useForm({
    issue_name: '',
    issue_description: '',
    system: '',
    issue_type: '',
    supporting_doc: null,
});

onMounted(()=>{
   fetchIssue(); 
   fetchSystem();
});

const handleFileChange = (event) => {
    form.supporting_doc = event.target.files[0];
};

const submit = () => {
    let formData = new FormData();
    formData.append('issue_name', form.issue_name);
    formData.append('issue_description', form.issue_description);
    formData.append('system', form.system);
    formData.append('issue_type', form.issue_type);
    if (form.supporting_doc) {
        formData.append('supporting_doc', form.supporting_doc);
    }

    form.post(route('issues.store'), {
        data: formData,
        onFinish: () => form.reset()
    });
};
// issues fetched
const fetchIssue = async()=>{
    const response = await axios.get(' http://fred-issues2.test/api/issues');
    IssueData.value = response.data;
    console.log(response.data);


}
const fetchSystem = async()=>{
    const response = await axios.get(' http://fred-issues2.test/api/systems');
    SystemData.value = response.data;
    console.log(response.data);


}

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Report Issue" />

        <div class="bg-white m-10 rounded-lg p-10">
            <p class="text-center pb-5 font-bold underline">Report an Issue experienced</p>

            <form @submit.prevent="submit" class="max-w-md mx-auto">
                <!-- Name of Issue -->
                <div class="mb-6">
                    <InputLabel for="issue_name" value="Name of Issue" />
                    <TextInput
                        id="issue_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.issue_name"
                        required
                        autofocus
                        autocomplete="issue_name"
                    />
                    <InputError class="mt-2" :message="form.errors.issue_name" />
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <InputLabel for="issue_description" value="Description" />
                    <TextInput
                        id="issue_description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.issue_description"
                        required
                        autocomplete="issue_description"
                    />
                    <InputError class="mt-2" :message="form.errors.issue_description" />
                </div>

                <!-- Select System -->
                <div class="mb-6">
                    <InputLabel for="system" value="Select System" />
                    <select id="system" name="system" class="form-select mt-1 block w-full" v-model="form.system">
                        <option disabled value="">Select a system</option>
                        <option v-for="system in SystemData" :value="system.id" :key="system.id">{{ system.name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.system" />
                </div>

                <!-- Select Issue Type -->
                <div class="mb-6">
                    <InputLabel for="issue_type" value="Type of Issue" />
                    <select id="issue_type" name="issue_type" class="form-select mt-1 block w-full" v-model="form.issue_type">
                        <option disabled value="">Select an issue type</option>
                        <option v-for="issueType in IssueData" :value="issueType.id" :key="issueType.id">{{ issueType.name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.issue_type" />
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
                        Report
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
