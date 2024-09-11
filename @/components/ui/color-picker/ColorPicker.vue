<script setup lang="ts">
import { ref, watch } from "vue";
import { Vue3ColorPicker } from "@cyhnkckali/vue3-color-picker";
import {Local, Mode} from "@cyhnkckali/vue3-color-picker/dist/core/types/types";

const props = defineProps<{
    type?: string,
    defaultColor?: string,
    defaultGradient?: string,
    preview?: boolean
}>();
const emit = defineEmits(['update:value']);

const value = ref()
const mode = () => {
    if(props.type) {
        if (['solid', 'gradient'].includes(props.type)) { return <Mode> props.type }
        else { return <Mode> 'solid' }
    } else { return <Mode> 'solid' }
}

watch(value, (newValue) => { emit('update:value', newValue); });

</script>

<template>
    <Vue3ColorPicker
        v-model="value"
        :mode="mode()"
        :showColorList="false"
        :showEyeDrop="false"
        :showPickerMode="false"
        :showInputMenu="false"
        type="RGB"
        theme="dark"
    />
</template>

<style lang="css">
.ck-cp-container {
    box-shadow: none !important;
    background-color: hsl(var(--background));
    border: 1px solid hsl(var(--border));
}
</style>
