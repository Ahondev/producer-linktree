<script setup lang="ts">

import { LinkItemInterface } from "../data/enum";
import LinkItem from "./LinkItem.vue";
import { Button } from "../../../../../../@/components/ui/button";
import {onMounted, ref} from "vue";
import PlusIcon from "./../../../components/icons/PlusIcon.vue";
import { uuid } from "@shadcn/lib/utils"

const props = defineProps<{
    defaultSelection: Record<string, LinkItemInterface>;
}>();

const emits = defineEmits<{
    (e: 'update-selection', selection: Record<string, LinkItemInterface>): void;
}>();

const linkItems = ref<Record<string, LinkItemInterface>>({});

const createLink = () => { linkItems.value[uuid()] = { platform: "_undefined", link: null }; emits("update-selection", linkItems.value) };
const removeLink = (uuid: string) => { delete linkItems.value[uuid]; emits("update-selection", linkItems.value) };
const updateLink = (uuid: string, link: LinkItemInterface) => { linkItems.value[uuid] = link; emits("update-selection", linkItems.value) }

const defaultSelection = ref<Record<string, LinkItemInterface> | null>(props.defaultSelection ?? null)

onMounted(() => {
    const selection = defaultSelection.value
    if(selection) {
        Object.keys(selection).forEach((key) => {
            linkItems.value[key] = {
                platform: selection[key]['platform'],
                url: selection[key]['url']
            }
        })
    }
})

</script>

<template>
    <div class="link-selector">
        <div class="link-selector-create">
            <Button type="button" variant="outline" @click.prevent="createLink()">
                <PlusIcon width="18px" height="18px" class="mr-1" />
                Ajouter un lien
            </Button>
            <!-- <IconPicker button-text="Ajouter un lien"/> -->
        </div>
        <div class="link-selector-items flex flex-col gap-2 pt-3">
            <LinkItem
                v-for="(link, uuid) in linkItems"
                :key="uuid"
                :uuid="uuid"
                :link="link"
                @remove-item="uuid => removeLink(uuid)"
                @update-item="(uuid, link) => updateLink(uuid, link)"
            />
        </div>
    </div>
</template>

<style scoped>
/* Add any scoped styles here */
</style>
