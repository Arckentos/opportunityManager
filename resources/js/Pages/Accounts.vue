<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

/**
 * Props
 */
const props = defineProps({ accounts: Object });

 
</script>

<template>
    <Head title="Accounts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Accounts</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="p-4">
                        <Link as="a" :href="route('accounts.create')">
                            <PrimaryButton>Create</PrimaryButton>
                        </Link>
                    </div>

                    <!-- Accounts table -->
                    <div class="px-4 pb-4">
                        <div class="border border-gray-200 rounded-md">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100 border-b border-gray-200">
                                        <th class="p-2 font-bold text-left text-gray-900">ID</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Name</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Group</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Owner</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Type</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Industry</th>
                                        <th class="p-2 pr-4"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <template v-for="(account, index) in accounts">
                                        <tr>
                                            <td class="px-2 py-1 text-gray-900">{{ account.id }}</td>
                                            <td class="px-2 py-1 text-gray-900">{{ account.name }}</td>
                                            <td class="px-2 py-1 text-gray-900">{{ account.accountGroup }}</td>
                                            <td class="px-2 py-1 text-gray-900">{{ account.accountOwner }}</td>
                                            <td class="px-2 py-1 text-gray-900">{{ account.type }}</td>
                                            <td class="px-2 py-1 text-gray-900">{{ account.industry }}</td>
                                            <td class="flex justify-between gap-2 px-2 py-1">
                                                <Link class="text-red-600 hover:underline underline-offset-4" :href="route('accounts.edit', account.id)" method="get" as="a">Edit</Link>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
