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
    <svg :width="width" :height="height" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor">
        <path d="M21 12L3 12M3 12L11.5 3.5M3 12L11.5 20.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</template>
