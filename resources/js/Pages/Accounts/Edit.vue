<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

/**
 * Props
 */
const props = defineProps({ account: Object });

/**
 * Variables
 */
const form = useForm({
    id: props.account.id,
    name: props.account.name,
    type: props.account.type,
    accountGroup: props.account.accountGroup,
    accountOwner: props.account.accountOwner,
    industry: props.account.industry,
});


</script>

<template>
    <Head title="Accounts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ account.name }}</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <form @submit.prevent="form.patch(route('accounts.update', form.id))">
                            <InputLabel :input-id="'name'">Name</InputLabel>
                            <TextInput id="name" v-model="form.name"></TextInput>
                            <InputLabel :input-id="'type'">Type</InputLabel>
                            <TextInput id="type" v-model="form.type"></TextInput>
                            <InputLabel :input-id="'accountGroup'">Group</InputLabel>
                            <TextInput id="accountGroup" v-model="form.accountGroup"></TextInput>
                            <InputLabel :input-id="'accountOwner'">Owner</InputLabel>
                            <TextInput id="accountOwner" v-model="form.accountOwner"></TextInput>
                            <InputLabel :input-id="'industry'">Industry</InputLabel>
                            <TextInput id="industry" v-model="form.industry"></TextInput>
                            <PrimaryButton>Create</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
