<script setup lang="ts">

const props = defineProps<{ tabActive: { type: boolean, default: false }; }>();
const isActive = () => props.tabActive ? 'true' : 'false';

</script>

<template>
    <div class="tab-content" :active="isActive()">
        <slot />
    </div>
</template>

<style scoped lang="scss">
.tab-content[active='false'] { display: none; }
</style>
