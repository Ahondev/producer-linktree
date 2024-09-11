<script setup lang="ts">
import { string } from "zod";

const props = defineProps({
    height: {
        type: string,
        default: "24px"
    },
    width: {
        type: string,
        default: "24px"
    }
})
</script>

<template>
    <svg :width="width" :height="height" stroke-width="1.5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" color="currentColor">
        <path d="M6 12H12M18 12H12M12 12V6M12 12V18" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</template>

<style scoped>

</style>
