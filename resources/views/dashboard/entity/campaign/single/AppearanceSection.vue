<script setup lang="ts">
import {Input} from "../../../../../../@/components/ui/input";
import {Label} from "../../../../../../@/components/ui/label";
import BackgroundSelector from "../../appearance/components/BackgroundSelector.vue";
import { ColorPicker } from "../../../../../../@/components/ui/color-picker";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "../../../../../../@/components/ui/tabs";
import { ImageUpload } from "../../../../../../@/components/ui/image-upload";
import { ref, watch } from "vue";
import { AppearanceInterface } from "./types";

const props = defineProps<{
    data: Object;
}>();

const emit = defineEmits<{ (e: 'update', appearance: AppearanceInterface) }>();

const value = ref<string>("color-simple")
const setValue = (_value: string): void => { value.value = _value }

const backgroundType = ref<string>(props.data.campaign.appearance.background_type)

const defaultColor = backgroundType.value === 'color-simple' ? props.data.campaign.appearance.value : 'rgb(255, 255, 255)'
const color = ref<string>(defaultColor)

const defaultGradient = backgroundType.value === 'color-gradient' ? props.data.campaign.appearance.value : 'rgb(255, 255, 255)'
const gradient = ref<string>(defaultGradient)

const image = ref<File>(null)
const imageURL = ref<string>("/uploads/placeholder.png")

const theme = ref<'light' | 'dark'>(props.data.campaign.appearance.theme)
const setTheme = (_theme: 'light' | 'dark'): void => { console.log('SET THEME :', _theme); theme.value = _theme }

watch(image, (image) => { imageURL.value = URL.createObjectURL(image) })

const getBackgroundPreview = () => {
    switch(backgroundType.value) {
        case 'color-simple': { return `background: ${color.value};` }
        case 'color-gradient': { return `background: ${gradient.value};` }
        case 'media-image': { return `background: url(${imageURL.value}); background-size: cover;` }
    }
}

const emitUpdate = () => { emit('update', {backgroundType: backgroundType.value, color: color.value, gradient: gradient.value, image: image.value, theme: theme.value}) }
setInterval(async () => { emitUpdate() }, 1000)

</script>

<template>
    <div class="appearance flex flex-col justify-start gap-3 mt-5">

        <div class="flex flex-col">
            <p class="text-m font-semibold mb-3">Apparence</p>
            <hr class="w-100 mb-5">
        </div>

        <div class="grid grid-2 gap-3">
            <form class="flex flex-col justify-start gap-5" action="">

                <div class="grid grid-2 gap-3">
                    <div class="flex flex-col gap-1">
                        <Label for="background-type">Thème</Label>
<!--   THIS FOR LOCAL   <Tabs :value="theme" @update:modelValue="_theme => setTheme(_theme.value)" class="w-full">  -->
<!--   THIS FOR PRODUCTION   <Tabs :value="theme" @update:modelValue="_theme => setTheme(_theme.value)" class="w-full">  -->
                        <Tabs :value="theme" @update:modelValue="_theme => setTheme(_theme)" class="w-full">
                            <TabsList class="grid w-full grid-cols-2 mb-2">
                                <TabsTrigger value="light" :is-default="props.data.campaign.appearance.theme === 'light'"> Clair </TabsTrigger>
                                <TabsTrigger value="dark" :is-default="props.data.campaign.appearance.theme === 'dark'">Sombre </TabsTrigger>
                            </TabsList>
                        </Tabs>
                    </div>
                    <div></div>
                </div>

                <div class="flex flex-col gap-1">
                    <Label for="background-type">Arrière-plan</Label>
                    <BackgroundSelector
                        id="background-type"
                        placeholder="Titre"
                        :default-type="props.data.campaign.appearance.background_type"
                        :default-value="getBackgroundPreview()"
                        @update:background-type="_backgroundType => backgroundType = _backgroundType"
                        @update:color-simple="_color => color = _color"
                        @update:color-gradient="_gradient => gradient = _gradient"
                        @update:media-image="_image => image = _image"
                    />
                </div>

            </form>

            <div class="background-preview flex flex-col gap-5">
                        <!--                <Label for="background.color-gradiant">Aperçu</Label>-->
                <div class="preview-container flex flex-col gap-2 justify-center mx-auto" :class="{'dark': theme === 'dark', 'light': theme === 'light'}">
                    <div class="preview-background" :style="getBackgroundPreview()" />
                    <div class="preview-title font-bold">Campagne</div>
                    <div class="preview-cover" :class="{'light': theme === 'light', 'dark': theme === 'dark'}">
<!--                        <img src=""-->
                    </div>
                    <div class="preview-text">Cliquez sur les liens ci dessous</div>
                    <div class="preview-cards grid grid-4 gap-1 mx-auto">
                        <div class="card"></div>
                        <div class="card"></div>
                        <div class="card"></div>
                        <div class="card"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</template>

<style scoped>
.preview-container {
    position: relative;
    max-width: 100%;
    max-height: 200px;
    height: 100%;
    width: 350px;
    border-radius: 0.8rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-top: 15%;
}
.preview-background {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}
.preview-title {
    text-align: center;
    font-size: .8rem;
}
.preview-text {
    text-align: center;
    font-size: .5em;
}
.preview-cover {
    height: 45px;
    width: 45px;
    border-radius: 4px;
    margin: 0 auto;
}
.preview-cover.dark { background-color: #121212; }
.preview-cover.light { background-color: #f7f7f7; }
.card {
    height: 25px;
    width: 25px;
    border-radius: 4px;
}
.preview-container.dark .card { background-color: #121212; }
.preview-container.dark .preview-text { color: #f7f7f7; }
.preview-container.dark .preview-title { color: #f7f7f7; }

.preview-container.light .card { background-color: #f7f7f7; }
.preview-container.light .preview-text { color: #121212; }
.preview-container.light .preview-title { color: #121212; }
</style>
