<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

/**
 * Variables
 */
const form = useForm({
    name: '',
    type: '',
    accountGroup: '',
    accountOwner: '',
    industry: '',
});


</script>

<template>
    <Head title="Accounts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Create a new account</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <form @submit.prevent="form.post(route('accounts.store'))">
                            <InputLabel :input-id="'name'">Name</InputLabel>
                            <TextInput id="name" type="text" v-model="form.name"></TextInput>
                            <InputLabel :input-id="'type'">Type</InputLabel>
                            <TextInput id="type" type="text" v-model="form.type"></TextInput>
                            <InputLabel :input-id="'accountGroup'">Group</InputLabel>
                            <TextInput id="accountGroup" type="text" v-model="form.accountGroup"></TextInput>
                            <InputLabel :input-id="'accountOwner'">Owner</InputLabel>
                            <TextInput id="accountOwner" type="text" v-model="form.accountOwner"></TextInput>
                            <InputLabel :input-id="'industry'">Industry</InputLabel>
                            <TextInput id="industry" type="text" v-model="form.industry"></TextInput>
                            <PrimaryButton>Create</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
