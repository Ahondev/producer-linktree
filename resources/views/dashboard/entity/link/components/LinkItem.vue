<script setup lang="ts">

import { Checkbox } from "../../../../../../@/components/ui/checkbox";
import { LinkItemInterface } from "../data/enum"
import {Input} from "../../../../../../@/components/ui/input";
import {Component, onMounted, ref} from "vue";
import {IconPicker} from "../../../../../../@/components/ui/icon-picker";
import {Label} from "../../../../../../@/components/ui/label";
import AppleMusicIcon from "../../../../../../@/components/ui/icon-picker/icons/AppleMusicIcon.vue";
import {Button} from "../../../../../../@/components/ui/button";
import TrashIcon from "../../../components/icons/TrashIcon.vue";
// import LinkItem from "./LinkItem.vue";

interface LinkItem {
    platform: string,
    url: string,
}

const props = defineProps<{
    link: LinkItemInterface;
    uuid: string;
}>();

const emits = defineEmits<{
    (e: 'remove-item', uuid: string): void;
    (e: 'update-item', uuid: string, link: LinkItem): void;
}>();

const iconComponent = ref<Component>(null);
const platform = ref<string>('');
const url = ref<string>(props.link.url ?? '');

const iconMap = {'AppleMusicIcon': 'apple_music', 'DeezerIcon': 'deezer', 'SpotifyIcon': 'spotify', 'SoundcloudIcon': 'soundcloud', 'PlusIcon': '_undefined'}
const reverseIconMap = Object.entries(iconMap).reduce((acc, [key, value]) => {
    acc[value] = key;
    return acc;
}, {} as Record<string, string>);

const onIconSelected = (icon) => {
    if(!icon .__name in iconMap) { return }
    iconComponent.value = icon
    platform.value = iconMap[icon.__name]
    emits('update-item', props.uuid, {platform: platform.value, url: url.value})
}

const removeItem = () => { emits('remove-item', props.uuid); }

const emitUpdate = () => { emits('update-item', props.uuid, {platform: platform.value, url: url.value}) }

</script>

<template>
    <div class="link-item rounded-lg border bg-card text-card-foreground shadow w-full flex flex-row justify-start align-center p-3 gap-10">
        <IconPicker
            :default-icon="reverseIconMap[props.link.platform]"
            @icon-selected="icon => onIconSelected(icon)"
        />
        <div class="flex flex-col gap-2 w-full">
            <Label for="url">Lien</Label>
            <Input @change="emitUpdate()" class="w-full" id="url" type="url" v-model="url" placeholder="https://example.com/" />
        </div>
        <div class="flex flex-col gap-2">
            <Label for="url" class="aria-label">Supprimer</Label>
            <Button variant="destructive" @click.prevent="removeItem()">
                <TrashIcon />
            </Button>
        </div>

    </div>
</template>

<style scoped>
svg, path {
    color: hsl(var(--foreground));
}
.aria-label {
    opacity: 0;
}
</style>
