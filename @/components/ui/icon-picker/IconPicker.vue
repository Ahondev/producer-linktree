<script setup lang="ts">
import {ref, computed, onMounted, nextTick} from 'vue';
import { useVModel } from '@vueuse/core';
import { HTMLAttributes } from 'vue';
import {Button} from "../button";
import PlusIcon from "../../../../resources/views/dashboard/components/icons/PlusIcon.vue";
import {Label} from "../label";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
    DialogClose
} from '@shadcn/components/ui/dialog'
import {LinkItemInterface} from "../../../../resources/views/dashboard/entity/link/data/enum";

// Define the props and emits for the component
const props = defineProps<{
    defaultValue?: string
    modelValue?: string
    class?: HTMLAttributes['class']
    id?: HTMLAttributes['id']
    buttonText?: string | number
    defaultIcon: string
}>();

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string): void
    (e: 'icon-selected', iconComponent): void
    // (e: 'icon-saved', iconName: string): void
}>();

// Use v-model for two-way data binding
const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
});

// Define the state for icons and the selected icon
const iconNames = ref<string[]>([]);
const selectedIcon = ref<string | null>(modelValue.value ?? null);

const uuid = crypto.randomUUID();

// Import all icon components dynamically
const iconComponents = import.meta.glob('./icons/*.vue', { eager: true });

const defaultIcon = ref<string | null>(props.defaultIcon ?? null)

onMounted(() => {
    // console.log(defaultIcon.value)
    // Extract icon names from the file paths
    iconNames.value = Object.keys(iconComponents).map(path => {
        // if (path === './icons/PlusIcon.vue') { console.log('plus'); return; }
        const fileName = path.split('/').pop();
        // console.log(fileName?.replace('.vue', '') || '')
        return fileName?.replace('.vue', '') || '';
    });
    if(defaultIcon) { selectIcon(defaultIcon.value); saveAndClose(defaultIcon.value); }
});

// Handle icon selection
const selectIcon = (icon: string) => {
    selectedIcon.value = icon;
    // emits('update:modelValue', icon);
};

// Handle icon save
// const saveIcon = (icon: string) => {
//     emits('icon-saved', icon);
// };

// Compute the component to render for the selected icon
const getIconComponent = computed(() => {
    const iconPath = `./icons/${selectedIcon.value}.vue`;
    const component = iconComponents[iconPath];
    return component ? component.default : null;
});

const saveAndClose = (icon: string) => {
    const iconComponent = iconComponents[`./icons/${icon}.vue`]?.default
    emits('icon-selected', iconComponent);
    setOpen(false)
}

const open = ref<boolean>(false);
const setOpen = (state) => { open.value = state }

const handleDialogUpdate = () => {
    const isopen = open.value
    if(isopen) { setOpen(!isopen) }
    else { selectedIcon.value = null; setOpen(!isopen) }
}
// const handleDialogUpdate = () => { setOpen(!open.value) }

const filteredIcons = computed(() => { return iconNames.value.filter(icon => icon !== 'PlusIcon'); })

</script>

<template>

    <Dialog :uuid="uuid" :open="open" @update:open="handleDialogUpdate()">
<!--    <Dialog>-->

        <DialogTrigger as-child>
            <div class="icon-picker flex flex-col justify-center align-start gap-2">
                <Label for="icon">Plateforme</Label>
                <Button type="button" class="h-auto" variant="outline">
                    <PlusIcon v-if="selectedIcon === null" width="24px" height="24px" />
                    <component v-if="selectedIcon !== null" :is="iconComponents[`./icons/${selectedIcon}.vue`]?.default" width="24px" height="24px" />
                </Button>
            </div>
        </DialogTrigger>

        <DialogContent class="sm:max-w-md">

            <DialogHeader>
                <DialogTitle>Plateforme</DialogTitle>
                <DialogDescription>
                    Sélectionnez la plateforme de votre choix.
                </DialogDescription>
            </DialogHeader>

            <div class="flex flex-row gap-2">
                <Button
                    v-for="icon in filteredIcons"
                    :key="icon"
                    variant="outline"
                    @click.prevent="selectIcon(icon)"
                    :class="{ 'selected': icon === selectedIcon }"
                    class="icon-button h-auto"
                >
                    <component :is="iconComponents[`./icons/${icon}.vue`]?.default" width="24px" height="24px" />
                </Button>
            </div>

<!--            <div v-if="selectedIcon" class="selected-icon">-->
<!--                <component :is="getIconComponent" />-->
<!--            </div>-->

            <DialogFooter class="sm:justify-between">

<!--                <DialogClose as-child>-->
<!--&lt;!&ndash;                    <Button type="button" variant="secondary" ref="closeTrigger">&ndash;&gt;-->
<!--                    <Button type="button" variant="secondary" @click.prevent="setOpen(false)">-->
<!--                        Annuler-->
<!--                    </Button>-->
<!--                </DialogClose>-->
                <div></div>
                <Button type="button" v-if="selectedIcon" @click="saveAndClose(selectedIcon)">
                    Selectionner
                </Button>

            </DialogFooter>
        </DialogContent>
    </Dialog>

</template>

<style scoped>
svg {
    color: hsl(var(--foreground));
}
button {
    padding: 8px;
}
.icon-button {
    width: fit-content;
    padding: 12px;
}
.icon-button.selected {
    border: 1px solid hsl(var(--foreground));
}
button.absolute {

}
</style>
