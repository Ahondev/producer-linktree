<script setup lang="ts">

import LinkSelector from "../../link/components/LinkSelector.vue";
import {Input} from "../../../../../../@/components/ui/input";
import {Label} from "../../../../../../@/components/ui/label";
import {ImageUpload} from "../../../../../../@/components/ui/image-upload";
import {ref, watch} from "vue";
import {LinkItemInterface} from "../../link/data/enum";
import { ContentInterface } from "./types";
import axios from "axios";
import {asArray} from "../../../../../../@/lib/utils";
import {toast} from "../../../../../../@/components/ui/toast";
import {api, asFormData, request, uuid} from "@shadcn/lib/utils"
import {data} from "autoprefixer";

const props = defineProps<{
    data: Object;
}>();

const emit = defineEmits<{ (e: 'update', content: ContentInterface) }>();

const appDomain = window.env.APP_DOMAIN
const campaignLink = `https://${appDomain}/${props.data.campaign.link}`
const defaultImageURL = ref(props.data.campaign.page.image_url ?? null)
const defaultLinks = () => {
    const links = props.data.campaign.page.links ?? {};
    return links.reduce((acc, link) => {
        acc[uuid()] = {url: link.url, platform: link.platform};
        return acc;
    }, {})
}

const title = ref<string>(props.data.campaign.page.title)
const image = ref<File>(null)
const text = ref<string>(props.data.campaign.page.text)
const links = ref<Record<string, LinkItemInterface>>(defaultLinks())

const emitUpdate = () => { emit('update', {title: title.value, image: image.value, text: text.value, links: links.value}) }

const isValid = () => title.value !== '' && text.value !== '' && (image.value !== null || defaultImageURL != null)

setInterval(async () => { emitUpdate() }, 1000)

</script>

<template>
    <div class="content flex flex-col justify-start gap-3">

        <div class="flex flex-col">
            <p class="text-m font-semibold mb-3">Contenu</p>
            <hr class="w-100 mb-5">
        </div>

        <form class="flex flex-col justify-start gap-3" action="">

            <div class="grid grid-2 gap-3">
                <div class="flex flex-col gap-1">
                    <Label for="title">Titre</Label>
                    <Input id="title" placeholder="Titre" v-model="title"></Input>
                </div>

                <div class="flex flex-col gap-1">
                    <Label for="image">Image</Label>
                    <ImageUpload
                        id="image"
                        placeholder="Name"
                        :default-url="defaultImageURL"
                        @upload="file => image = file"
                    />
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <Label for="text">Description</Label>
                <Input id="text" placeholder="Description" v-model="text"></Input>
            </div>

            <div class="flex flex-col gap-1">
                <Label for="links">Liens</Label>
                <LinkSelector
                    id="links"
                    :default-selection="links"
                    @update-selection="selection => links.value = selection"
                />
            </div>

        </form>

    </div>
</template>

<style scoped>

</style>
