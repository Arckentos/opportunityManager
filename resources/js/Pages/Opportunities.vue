<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import QuickView from '@/Pages/Opportunities/QuickView.vue';
import { ArrowUpOnSquareIcon } from '@heroicons/vue/24/outline';

/**
 * Variables
 */
const filters = useForm({
    rowNumber: 20,
    search: '',
    configuration: 'default',
    sbu: {
        aut: {
            label: 'AUT',
            value: true,
        },
        ind: {
            label: 'IND',
            value: true
        },
    },
    sites: {
        act: {
            label: 'ACT',
            value: true
        },
        bms: {
            label: 'BMS',
            value: true
        },
        gdl: {
            label: 'GDL',
            value: true
        },
        msl: {
            label: 'MSL',
            value: true
        },
        tis: {
            label: 'TIS',
            value: true
        },
    },
    accountTypes: {
        customer: {
            label: 'Customer',
            value: true
        },
        prospect: {
            label: 'Prospect',
            value: true
        },
    },
    opportunityTypes: {
        rfq: {
            label: 'RFQ',
            value: true
        },
        service: {
            label: 'Service',
            value: false
        },
    },
    columns: {
        opp: {
            label: 'Opp#',
            value: true,
        },
        site: {
            label: 'Site',
            value: true,
        },
        owner: {
            label: 'Owner',
            value: true,
        },
        accountName: {
            label: 'Account Name',
            value: true,
        },
        gam: {
            label: 'GAM',
            value: false,
        },
        groupName: {
            label: 'Group Name',
            value: false,
        },
    },
    owners: {
        cpa: {
            label: 'CPA',
            value: true,
        },
        eau: {
            label: 'EAU',
            value: false,
        },
    },
    statuses: {
        discovery: {
            label: 'Discovery',
            value: true,
        },
        quote: {
            label: 'Quote',
            value: true,
        },
        pending: {
            label: 'Pending',
            value: true,
        },
        declined: {
            label: 'Declined',
            value: true,
        },
        canceled: {
            label: 'Canceled',
            value: true,
        },
        standBy: {
            label: 'Stand by',
            value: true,
        },
        lost: {
            label: 'Lost',
            value: true,
        },
        won: {
            label: 'Won',
            value: true,
        },
    },
});

const isFiltersWindowOpen = ref(false);
const isFiltersColumnsOpen = ref(false);
const isFiltersOwnersOpen = ref(false);
const isFiltersStatusesOpen = ref(false);
const isQuickViewOpen = ref(false);

/**
 * Functions
 */
function toggleFiltersWindow() {
    isFiltersWindowOpen.value = !isFiltersWindowOpen.value;
    isFiltersColumnsOpen.value = false;
    isFiltersOwnersOpen.value = false;
    isFiltersStatusesOpen.value = false;
}

function toggleFiltersColumns() {
    isFiltersColumnsOpen.value = !isFiltersColumnsOpen.value;
    isFiltersOwnersOpen.value = false;
    isFiltersStatusesOpen.value = false;
}

function toggleFiltersOwners() {
    isFiltersColumnsOpen.value = false;
    isFiltersOwnersOpen.value = !isFiltersOwnersOpen.value;
    isFiltersStatusesOpen.value = false;
}

function toggleFiltersStatuses() {
    isFiltersColumnsOpen.value = false;
    isFiltersOwnersOpen.value = false;
    isFiltersStatusesOpen.value = !isFiltersStatusesOpen.value
}

function openQuickView(idOpp) {
    // Get the quick data for the idOpp
    isQuickViewOpen.value = true;
}

function closeQuickView() {
    isQuickViewOpen.value = false;
}
</script>

<template>
    <Head title="Opportunities" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Opportunities</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
                <div class="relative bg-white shadow-sm sm:rounded-lg">
                    <!-- Filters -->
                    <div class="relative flex justify-between gap-4 p-4">
                        <select class="w-20 px-4 py-2 text-gray-900 border border-gray-200 rounded-md h-min" name="filter_row_number" id="filter_row_number" v-model="filters.rowNumber">
                            <option value="10">10</option>
                            <option value="20" selected>20</option>
                        </select>
                        <div class="flex justify-end gap-4">
                            <TextInput class="w-auto md:w-72" id="filter_search" placeholder="Search" v-model="filters.search" ref="filterSearchInput" type="search" />
                            <button class="flex items-center gap-2 px-4 py-2 text-gray-900 border border-gray-200 rounded-md active:border-gray-300 active:bg-gray-100 hover:bg-gray-50">
                                <ArrowUpOnSquareIcon class="w-5 h-5" />Export
                            </button>
                            <button class="px-4 py-2 text-gray-900 border border-gray-200 rounded-md active:border-gray-300 active:bg-gray-100 hover:bg-gray-50" @click="toggleFiltersWindow">Filters</button>
                        </div>
                    </div>

                    <!-- Filters window -->
                    <div class="relative w-full transition-all ease-in-out delay-75 transform" v-if="isFiltersWindowOpen">
                        <div class="absolute top-0 flex bg-white border border-gray-200 divide-x divide-gray-200 rounded-lg rounded-tr-none shadow right-4 min-w-1/6 sm:rounded-tr-lg">
                            <!-- Filters options -->
                            <div class="divide-y divide-gray-200">
                                <div class="flex flex-col gap-2 p-3">
                                    <h2 class="text-lg text-left text-gray-500">Filters options</h2>
                                    <select class="w-auto p-2 pr-10 text-gray-900 border border-gray-200 rounded-md h-max" name="filter_configuration" id="filter_configuration" v-model="filters.configuration">
                                        <option value="default" selected>Default</option>
                                        <option value="1">All Business Won</option>
                                        <optgroup label="Saved searches">
                                            <option value="saved_1">Saved 1</option>
                                        </optgroup>
                                    </select>
                                    <SecondaryButton @click="toggleFiltersColumns">Columns</SecondaryButton>
                                    <SecondaryButton @click="toggleFiltersOwners">Owners</SecondaryButton>
                                    <SecondaryButton @click="toggleFiltersStatuses">Status</SecondaryButton>
                                </div>

                                <!-- SBU -->
                                <div class="p-3">
                                    <h3 class="text-base text-left text-gray-500">SBU</h3>
                                    <div class="grid max-w-sm grid-cols-2 gap-1 mt-1">
                                        <template v-for="(one_sbu, indexSBU) in filters.sbu">
                                            <div class="flex gap-2">
                                                <Checkbox :id="'filters_sbu_' + one_sbu.label" v-model:checked="one_sbu.value" />
                                                <InputLabel class="cursor-pointer" :value="one_sbu.label" :inputId="'filters_sbu_' + one_sbu.label" />
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Sites -->
                                <div class="p-3">
                                    <h3 class="text-base text-left text-gray-500">Sites</h3>
                                    <div class="grid max-w-sm grid-cols-2 gap-1 mt-1">
                                        <template v-for="(site, index) in filters.sites">
                                            <div class="flex gap-2">
                                                <Checkbox :id="'filters_sites_' + site.label" v-model:checked="site.value" />
                                                <InputLabel class="cursor-pointer" :value="site.label" :inputId="'filters_sites_' + site.label" />
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Account types -->
                                <div class="p-3">
                                    <h3 class="text-base text-left text-gray-500">Account types</h3>
                                    <div class="grid max-w-sm grid-cols-2 gap-2 mt-1">
                                        <template v-for="(accountType, index) in filters.accountTypes">
                                            <div class="flex gap-2">
                                                <Checkbox :id="'filters_account_types_' + accountType.label" v-model:checked="accountType.value" />
                                                <InputLabel class="cursor-pointer" :value="accountType.label" :inputId="'filters_account_types_' + accountType.label" />
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Opportunity Type -->
                                <div class="p-3">
                                    <h3 class="text-base text-left text-gray-500">Opportunity types</h3>
                                    <div class="grid max-w-sm grid-cols-2 gap-2 mt-1">
                                        <template v-for="(opportunityType, index) in filters.opportunityTypes">
                                            <div class="flex gap-2">
                                                <Checkbox :id="'filters_opportunity_types_' + opportunityType.label" v-model:checked="opportunityType.value" />
                                                <InputLabel class="cursor-pointer" :value="opportunityType.label" :inputId="'filters_opportunity_types_' + opportunityType.label" />
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="p-3 text-center">
                                    <PrimaryButton>Save search</PrimaryButton>
                                </div>
                            </div>

                            <!-- Filters columns -->
                            <div class="transition-all delay-75 transform" v-if="isFiltersColumnsOpen">
                                <h3 class="m-3 text-base text-left text-gray-500">Columns</h3>
                                <div class="flex flex-col divide-y divide-gray-200">
                                    <!-- Shown -->
                                    <div class="px-3 pb-3">
                                        <h4 class="text-sm text-left text-gray-500">Shown</h4>
                                        <div class="grid max-w-sm grid-cols-2 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(column, index) in filters.columns">
                                                <div class="flex gap-2" v-if="column.value == true">
                                                    <Checkbox :id="'filters_columns_' + column.label" v-model:checked="column.value" />
                                                    <InputLabel class="cursor-pointer" :value="column.label" :inputId="'filters_columns_' + column.label" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <!-- Hidden -->
                                    <div class="p-3">
                                        <h4 class="text-sm text-left text-gray-500">Hidden</h4>
                                        <div class="grid max-w-sm grid-cols-2 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(column, index) in filters.columns">
                                                <div class="flex gap-2" v-if="column.value == false">
                                                    <Checkbox :id="'filters_columns_' + column.label" v-model:checked="column.value" />
                                                    <InputLabel class="cursor-pointer" :value="column.label" :inputId="'filters_columns_' + column.label" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filters owners -->
                            <div class="transition-all delay-75 transform" v-if="isFiltersOwnersOpen">
                                <h3 class="m-3 text-base text-left text-gray-500">Owners</h3>
                                <div class="flex flex-col divide-y divide-gray-200">
                                    <!-- Shown -->
                                    <div class="px-3 pb-3">
                                        <h4 class="text-sm text-left text-gray-500">Shown</h4>
                                        <div class="grid max-w-sm grid-cols-3 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(owner, index) in filters.owners">
                                                <div class="flex gap-2" v-if="owner.value == true">
                                                    <Checkbox :id="'filters_owners_' + owner.label" v-model:checked="owner.value" />
                                                    <InputLabel class="cursor-pointer" :value="owner.label" :inputId="'filters_owners_' + owner.label" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <!-- Hidden -->
                                    <div class="p-3">
                                        <h4 class="text-sm text-left text-gray-500">Hidden</h4>
                                        <div class="grid max-w-sm grid-cols-3 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(owner, index) in filters.owners">
                                                <div class="flex gap-2" v-if="owner.value == false">
                                                    <Checkbox :id="'filters_owners_' + owner.label" v-model:checked="owner.value" />
                                                    <InputLabel class="cursor-pointer" :value="owner.label" :inputId="'filters_owners_' + owner.label" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filters statuses -->
                            <div class="transition-all delay-75 transform" v-if="isFiltersStatusesOpen">
                                <h3 class="m-3 text-base text-left text-gray-500">Status</h3>
                                <div class="flex flex-col divide-y divide-gray-200">
                                    <!-- Shown -->
                                    <div class="px-3 pb-3">
                                        <h4 class="text-sm text-left text-gray-500">Shown</h4>
                                        <div class="grid max-w-sm grid-cols-2 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(status, index) in filters.statuses">
                                                <div class="flex gap-2" v-if="status.value == true">
                                                    <Checkbox :id="'filters_statuses_' + status.label" v-model:checked="status.value" />
                                                    <InputLabel class="cursor-pointer" :value="status.label" :inputId="'filters_statuses_' + status.label" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <!-- Hidden -->
                                    <div class="p-3">
                                        <h4 class="text-sm text-left text-gray-500">Hidden</h4>
                                        <div class="grid max-w-sm grid-cols-2 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(status, index) in filters.statuses">
                                                <div class="flex gap-2" v-if="status.value == false">
                                                    <Checkbox :id="'filters_statuses_' + status.label" v-model:checked="status.value" />
                                                    <InputLabel class="cursor-pointer" :value="status.label" :inputId="'filters_statuses_' + status.label" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opportunities table -->
                    <div class="px-4 pb-4">
                        <div class="border border-gray-200 rounded-md">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100 border-b border-gray-200">
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="filters.columns.opp.value">Opp#</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="filters.columns.site.value">Site</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="filters.columns.owner.value">Owner</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="filters.columns.accountName.value">Account name</th>
                                        <th class="p-2 font-bold text-left text-gray-900">SBU</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Project Name</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Status</th>
                                        <th class="p-2 font-bold text-left text-gray-900">Annual Rev (k€)</th>
                                        <th class="p-2 font-bold text-left text-gray-900">LTR (M€)</th>
                                        <th class="p-2 font-bold text-left text-gray-900">LTQ (ku)</th>
                                        <th class="p-2 font-bold text-left text-gray-900">SOP</th>
                                        <th class="p-2 pr-4"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="px-2 py-1 text-gray-900" v-if="filters.columns.opp.value">23001BMSCPv1</td>
                                        <td class="px-2 py-1 text-gray-900" v-if="filters.columns.site.value">BMS</td>
                                        <td class="px-2 py-1 text-gray-900" v-if="filters.columns.owner.value">CPA</td>
                                        <td class="flex justify-start gap-2 px-2 py-1 text-gray-900" v-if="filters.columns.accountName.value">
                                            <img class="w-5 h-5" :src="'/upload/accounts/tesla/tesla.png'" alt="Tesla Logo">
                                            <span>Tesla</span>
                                        </td>
                                        <td class="px-2 py-1 text-gray-900">AUT</td>
                                        <td class="px-2 py-1 text-gray-900">Model A BMU</td>
                                        <td class="px-2 py-1 text-center text-gray-900 bg-green-300">Won</td>
                                        <td class="px-2 py-1 text-right text-gray-900">1 000</td>
                                        <td class="px-2 py-1 text-right text-gray-900">7,000</td>
                                        <td class="px-2 py-1 text-right text-gray-900">140</td>
                                        <td class="px-2 py-1 text-gray-900">Q4 2024</td>
                                        <td class="flex justify-between gap-2 px-2 py-1">
                                            <button class="text-red-600 hover:underline underline-offset-4" @click="openQuickView">Quick view</button>
                                            <Link class="text-red-600 hover:underline underline-offset-4" href="/opportunities/1" method="get" as="button">Edit</Link>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-1 text-gray-900" v-if="filters.columns.opp.value">23001BMSCPv1</td>
                                        <td class="px-2 py-1 text-gray-900" v-if="filters.columns.site.value">BMS</td>
                                        <td class="px-2 py-1 text-gray-900" v-if="filters.columns.owner.value">CPA</td>
                                        <td class="flex justify-start gap-2 px-2 py-1 text-gray-900" v-if="filters.columns.accountName.value">
                                            <img class="w-5 h-5" :src="'/upload/accounts/tesla/tesla.png'" alt="Tesla Logo">
                                            <span>Tesla</span>
                                        </td>
                                        <td class="px-2 py-1 text-gray-900">AUT</td>
                                        <td class="px-2 py-1 text-gray-900">Model A BMU</td>
                                        <td class="px-2 py-1 text-center text-gray-900 bg-green-300">Won</td>
                                        <td class="px-2 py-1 text-right text-gray-900">1 000</td>
                                        <td class="px-2 py-1 text-right text-gray-900">7,000</td>
                                        <td class="px-2 py-1 text-right text-gray-900">140</td>
                                        <td class="px-2 py-1 text-gray-900">Q4 2024</td>
                                        <td class="flex justify-between gap-2 px-2 py-1">
                                            <button class="text-red-600 hover:underline underline-offset-4" @click="openQuickView">Quick view</button>
                                            <Link class="text-red-600 hover:underline underline-offset-4" href="/opportunities/1" method="get" as="button">Edit</Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- QuickView -->
                    <QuickView v-if="isQuickViewOpen" @close-quick-view="closeQuickView"></QuickView>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
