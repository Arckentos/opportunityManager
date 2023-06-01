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
import { onBeforeMount } from 'vue';

/**
 * Props
 */
 const props = defineProps({ opportunities: Object });

 
/**
 * Variables
 */
const filters = useForm({
    search: '',
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

const userCustomization = ref({
    rowNumber: 20,
    configuration: 'default',
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
        sbu: {
            label: 'SBU',
            value: true,
        },
        projectName: {
            label: 'Project Name',
            value: true,
        },
        status: {
            label: 'Status',
            value: true,
        },
        annualRev: {
            label: 'Annual Rev',
            value: true,
        },
        ltr: {
            label: 'LTR',
            value: true,
        },
        ltq: {
            label: 'LTQ',
            value: true,
        },
        sop: {
            label: 'SOP',
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
});

const isFiltersWindowOpen = ref(false);
const isCustomizationColumnsOpen = ref(false);
const isFiltersOwnersOpen = ref(false);
const isFiltersStatusesOpen = ref(false);
const isQuickViewOpen = ref(false);

const quickViewOpportunity = ref({});


/**
 * Functions
 */
function toggleFiltersWindow() {
    isFiltersWindowOpen.value = !isFiltersWindowOpen.value;
    isCustomizationColumnsOpen.value = false;
    isFiltersOwnersOpen.value = false;
    isFiltersStatusesOpen.value = false;
}

function toggleFiltersColumns() {
    isCustomizationColumnsOpen.value = !isCustomizationColumnsOpen.value;
    isFiltersOwnersOpen.value = false;
    isFiltersStatusesOpen.value = false;
}

function toggleFiltersOwners() {
    isCustomizationColumnsOpen.value = false;
    isFiltersOwnersOpen.value = !isFiltersOwnersOpen.value;
    isFiltersStatusesOpen.value = false;
}

function toggleFiltersStatuses() {
    isCustomizationColumnsOpen.value = false;
    isFiltersOwnersOpen.value = false;
    isFiltersStatusesOpen.value = !isFiltersStatusesOpen.value
}

function openQuickView(opportunityId) {
    isQuickViewOpen.value = true;
    quickViewOpportunity.value = props.opportunities[opportunityId];
}

function closeQuickView() {
    isQuickViewOpen.value = false;
    quickViewOpportunity.value = {};
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
                        <select class="w-20 px-4 py-2 text-gray-900 border border-gray-200 rounded-md h-min" name="user_customization_row_number" id="user_customization_row_number" v-model="userCustomization.rowNumber">
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
                    <div class="relative w-full" v-if="isFiltersWindowOpen">
                        <div class="absolute top-0 flex bg-white border border-gray-200 divide-x divide-gray-200 rounded-lg rounded-tr-none shadow right-4 min-w-1/6 sm:rounded-tr-lg">
                            <!-- Filters options -->
                            <div class="divide-y divide-gray-200">
                                <div class="flex flex-col gap-2 p-3">
                                    <h2 class="text-lg text-left text-gray-500">Filters options</h2>
                                    <select class="w-auto p-2 pr-10 text-gray-900 border border-gray-200 rounded-md h-max" name="user_customization_configuration" id="user_customization_configuration" v-model="userCustomization.configuration">
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

                            <!-- Customization columns -->
                            <div class="transition-all delay-75 transform" v-if="isCustomizationColumnsOpen">
                                <h3 class="m-3 text-base text-left text-gray-500">Columns</h3>
                                <div class="flex flex-col divide-y divide-gray-200">
                                    <!-- Shown -->
                                    <div class="px-3 pb-3">
                                        <h4 class="text-sm text-left text-gray-500">Shown</h4>
                                        <div class="grid max-w-sm grid-cols-2 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(column, index) in userCustomization.columns">
                                                <div class="flex gap-2" v-if="column.value == true">
                                                    <Checkbox :id="'user_customization_columns_' + column.label" v-model:checked="column.value" />
                                                    <InputLabel class="cursor-pointer" :value="column.label" :inputId="'user_customization_columns_' + column.label" />
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <!-- Hidden -->
                                    <div class="p-3">
                                        <h4 class="text-sm text-left text-gray-500">Hidden</h4>
                                        <div class="grid max-w-sm grid-cols-2 gap-2 mt-1 md:grid-cols-3">
                                            <template v-for="(column, index) in userCustomization.columns">
                                                <div class="flex gap-2" v-if="column.value == false">
                                                    <Checkbox :id="'user_customization_columns_' + column.label" v-model:checked="column.value" />
                                                    <InputLabel class="cursor-pointer" :value="column.label" :inputId="'user_customization_columns_' + column.label" />
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
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.opp.value">Opp#</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.site.value">Site</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.owner.value">Owner</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.accountName.value">Account name</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.sbu.value">SBU</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.projectName.value">Project Name</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.status.value">Status</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.annualRev.value">Annual Rev (k€)</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.ltr.value">LTR (M€)</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.ltq.value">LTQ (ku)</th>
                                        <th class="p-2 font-bold text-left text-gray-900" v-if="userCustomization.columns.sop.value">SOP</th>
                                        <th class="p-2 pr-4"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <template v-for="(opportunity, index) in opportunities">
                                        <tr>
                                            <td class="px-2 py-1 text-gray-900" v-if="userCustomization.columns.opp.value">{{ opportunity.opp }}</td>
                                            <td class="px-2 py-1 text-gray-900" v-if="userCustomization.columns.site.value">{{ opportunity.site }}</td>
                                            <td class="px-2 py-1 text-gray-900" v-if="userCustomization.columns.owner.value">{{ opportunity.owner }}</td>
                                            <td class="flex justify-start gap-2 px-2 py-1 text-gray-900" v-if="userCustomization.columns.accountName.value">
                                                <img class="w-5 h-5" :src="'/upload/accounts/tesla/tesla.png'" alt="Tesla Logo">
                                                <span>{{ opportunity.accountName }}</span>
                                            </td>
                                            <td class="px-2 py-1 text-gray-900" v-if="userCustomization.columns.sbu.value">{{ opportunity.sbu }}</td>
                                            <td class="px-2 py-1 text-gray-900" v-if="userCustomization.columns.projectName.value">{{ opportunity.projectName }}</td>
                                            <td class="px-2 py-1 text-center text-gray-900 bg-green-300" v-if="userCustomization.columns.status.value">{{ opportunity.status }}</td>
                                            <td class="px-2 py-1 text-right text-gray-900" v-if="userCustomization.columns.annualRev.value">{{ opportunity.annualRev }}</td>
                                            <td class="px-2 py-1 text-right text-gray-900" v-if="userCustomization.columns.ltr.value">{{ opportunity.ltr }}</td>
                                            <td class="px-2 py-1 text-right text-gray-900" v-if="userCustomization.columns.ltq.value">{{ opportunity.ltq }}</td>
                                            <td class="px-2 py-1 text-gray-900" v-if="userCustomization.columns.sop.value">{{ opportunity.sop }}</td>
                                            <td class="flex justify-between gap-2 px-2 py-1">
                                                <button class="text-red-600 hover:underline underline-offset-4" @click="openQuickView(opportunity.id)">Quick view</button>
                                                <Link class="text-red-600 hover:underline underline-offset-4" :href="'/opportunities/' + opportunity.id" method="get" as="a">Edit</Link>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- QuickView -->
                    <QuickView v-if="isQuickViewOpen" :quick-view-opportunity="quickViewOpportunity" @close-quick-view="closeQuickView"></QuickView>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
