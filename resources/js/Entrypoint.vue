<template>
    <app-container>
        <component :is="component" />
        <Toaster />
    </app-container>
</template>

<script>
import Toaster from '@shadcn/components/ui/toast/Toaster.vue'
export default {
    name: "Entrypoint",
    props: ["component", "data", "user"],
    components: { Toaster },
    mounted: () => {
        console.log('[vuejs] data : ', window.data)
    }
}
</script>
