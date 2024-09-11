<template>
    <Application>

        <div class="buttons flex flex-row w-100 justify-between mb-7">
            <Button type="button" variant="secondary" class="mb-5" @click="redirect('/dashboard/campaigns')">
                <ArrowBack width="14px" height="14px" class="mr-2" />
                Retour
            </Button>
            <Button
                type="button"
                @click="submit()"
                v-bind:disabled="!isValid()"
            >Mettre à jour</Button>
        </div>

        <div class="flex flex-col align-start">
            <h1 class="text-xl font-semibold mb-1 mr-3">{{ data.campaign.name }}</h1>
            <a :href="campaignLink" class="text-muted-foreground text-sm mb-7">{{ campaignLink }}</a>
        </div>

        <ContentSection
            :data="data"
            @update="_content => content = _content"
        />

        <AppearanceSection
            :data="data"
            @update="_appearance => appearance = _appearance"
        />

    </Application>
</template>

<script setup lang="ts">
import Application from "../../layout/Application.vue";
import ArrowBack from "../../components/icons/ArrowBack.vue";
import {Button} from "../../../../../@/components/ui/button";
import {Label} from "../../../../../@/components/ui/label";
import axios from "axios";
import {api, asFormData, redirect, request} from "@shadcn/lib/utils"
import {toast} from "../../../../../@/components/ui/toast";
import {asArray} from "../../../../../@/lib/utils";
import AppearanceSection from "./single/AppearanceSection.vue";
import ContentSection from "./single/ContentSection.vue";
import {ref} from "vue";
import {AppearanceInterface, ContentInterface} from "./single/types";

const data = window.data
const appDomain = window.env.APP_DOMAIN
const campaignLink = `https://${appDomain}/${data.campaign.link}`

const content = ref<ContentInterface>(null)
const appearance = ref<AppearanceInterface>(null)

const isValid = () => content != null && appearance !== null

const submit = async () => {

    const content_status = await updateContent()
    const appearance_status = await updateAppearance()

    if (content_status.status === 200 && appearance_status.status === 200) {
        toast({
            title: 'Success',
            description: 'Campaign updated successfully!',
        })
    } else {
        toast({
            title: 'Error',
            description: 'An error occurred while updating campaign',
        })
    }

}

const updateContent = async () => {
    return await request(axios.post, api(`page/${data.campaign.link}`), asFormData({
        _method: 'put',
        title: content.value.title,
        text: content.value.text,
        image: content.value.image,
        links: asArray(content.value.links.value)
    }))
}

const updateAppearance = async () => {
    //update appearance entity
    const value = () => {
        switch (appearance.value.backgroundType) {
            case 'color-simple': return appearance.value.color
            case 'color-gradient': return appearance.value.gradient
            case 'media-image': return appearance.value.image
        }
    }

    return await request(axios.post, api(`appearance/${data.campaign.link}`), asFormData({
        _method: 'put',
        'background_type': appearance.value.backgroundType,
        value: value(),
        theme: appearance.value.theme,
    }))
}

</script>

<style scoped>
label { cursor: pointer; }
.buttons {
    position: sticky;
    top: 68px;
    z-index: 1;
    &::after {
        content: '';
        position: absolute;
        top: -20px;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: red;
        z-index: -1;
        background-color: hsl(var(--background));
    }
}
</style>
