<template>
    <div class="absolute top-0 right-0 max-w-6xl bg-white border-gray-200 shadow-md sm:rounded-lg">
        <!-- Header -->
        <div class="flex items-center justify-between gap-6 p-4">
            <div class="flex items-center gap-4">
                <img class="w-5 h-5" :src="'/upload/accounts/tesla/tesla.png'" alt="Tesla Logo">
                <h2 class="text-lg text-left text-gray-800">{{ quickViewOpportunity.projectName }}</h2>
            </div>
            <div class="flex items-center justify-between gap-4">
                <h3 class="text-base text-left text-gray-800">{{ quickViewOpportunity.site }}</h3>
                <XMarkIcon class="w-5 h-5 text-gray-500 cursor-pointer hover:text-gray-800" @click="$emit('closeQuickView')"></XMarkIcon>
            </div>
        </div>

        <!-- Opportunity Informations -->
        <div class="px-4 pb-4">
            <div class="grid grid-cols-2 gap-1">
                <InputLabel class="text-zinc-500">Opp#</InputLabel><InputLabel>{{ quickViewOpportunity.opp }}</InputLabel>
                <InputLabel class="text-zinc-500">Owner</InputLabel><InputLabel>{{ quickViewOpportunity.owner }}</InputLabel>
                <InputLabel class="text-zinc-500">SBU</InputLabel><InputLabel>{{ quickViewOpportunity.sbu }}</InputLabel>
                <InputLabel class="text-zinc-500">Status</InputLabel><InputLabel>{{ quickViewOpportunity.status }}</InputLabel>
                <InputLabel class="text-zinc-500">Account name</InputLabel><InputLabel>{{ quickViewOpportunity.accountName }}</InputLabel>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { XMarkIcon } from '@heroicons/vue/24/outline';

/**
 * Props
 */
const props = defineProps({
    quickViewOpportunity: Object
});

/**
 * Variables
 */
const quickViewOpportunity = props.quickViewOpportunity;

</script>