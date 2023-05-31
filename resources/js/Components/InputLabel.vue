<script setup>
defineProps({
    value: {
        type: String,
    },
    inputId: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <label class="block text-sm font-medium text-gray-700" :for="inputId">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
