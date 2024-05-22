<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
    issue_name: '',
    description: '',
    system:'',
    supporting_doc:'',
});

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
                            autocomplete="issue name"
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
                            <option value="crims">CRIMS</option>
                            <option value="staff">CySuites</option>
                            <option value="admin">CyTravel</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <InputLabel for="issue_type" value="Type of Issue" />

                        <select id="issue_type" name="issue_type" class="form-select mt-1 block w-full" v-model="form.issue_type">
                            <option value="authentication">authentication</option>
                            <option value="connection">connection</option>
                            <option value="document_upload">document upload</option>
                            <option value="other">other</option>
                        </select>
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
                        <PrimaryButton class="px-4 py-2" :class="{ 'opacity-25': form.report-issue }" :disabled="form.report-issue">
                            Report
                        </PrimaryButton>
                    </div>
                </form>
        
        </div>

        
    </AuthenticatedLayout>
</template>
