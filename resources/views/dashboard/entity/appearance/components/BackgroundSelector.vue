<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '../../../../../../@/components/ui/card'
import { Input } from '../../../../../../@/components/ui/input'
import { Label } from '../../../../../../@/components/ui/label'
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '../../../../../../@/components/ui/tabs'
import { nextTick, onMounted, ref, watch } from "vue";
import { ColorPicker } from "../../../../../../@/components/ui/color-picker";
import { ImageUpload } from "../../../../../../@/components/ui/image-upload";

const props = defineProps<{
    defaultType: 'color-simple' | 'color-gradient' | 'media-image',
    defaultValue: string
}>()

const emit = defineEmits<{
    (e: 'update:background-type', backgroundType: 'color-simple' | 'color-gradient' | 'media-image')
    (e: 'update:color-simple', color: string)
    (e: 'update:color-gradient', color: string)
    (e: 'update:media-image', image: File)
}>()

const value = ref<string>("color-simple")
const setValue = (_value: string): void => { value.value = _value; emit('update:background-type', _value) }
const isTabActive = (_value: string): boolean => value.value === _value

const color = ref<string>("rgb(255, 255, 255)")
const gradient = ref<string>("rgb(255, 255, 255)")
const image = ref<File>()
// const imageURL = ref<string>("")

watch(color, (color: string) => { emit('update:color-simple', color) })
watch(gradient, (gradient: string) => { emit('update:color-gradient', gradient) })
watch(image, (image: File) => { emit('update:media-image', image) })

</script>

<template>

    <div class="grid grid-col grid-1 gap-5">
        <Tabs :value="value" @update:modelValue="_value => setValue(_value)" class="w-full">

            <TabsList class="grid w-full grid-cols-3 mb-2">
                <TabsTrigger value="color-simple" :is-default="props.defaultType === 'color-simple'"> Couleur </TabsTrigger>
                <TabsTrigger value="color-gradient" :is-default="props.defaultType === 'color-gradient'"> Dégradé </TabsTrigger>
                <TabsTrigger value="media-image" :is-default="props.defaultType === 'media-image'"> Image </TabsTrigger>
<!--                <TabsTrigger value="media-video"> Vidéo </TabsTrigger>-->
            </TabsList>

            <TabsContent class="flex flex-col gap-1 min-h-[400px]" value="color-simple" :tab-active="isTabActive('color-simple')">
                <!--            <Label for="background.color-simple">Couleur</Label>-->
                <ColorPicker v-model="color" :default-color="color" id="background.color-simple" />
            </TabsContent>

            <TabsContent class="flex flex-col gap-1 min-h-[400px]" value="color-gradient" :tab-active="isTabActive('color-gradient')">
                <!--            <Label for="background.color-gradiant">Dégradé</Label>-->
                <ColorPicker v-model="gradient" :default-gradient="gradient" id="background.color-simple" type="gradient" />
            </TabsContent>

            <TabsContent class="flex flex-col gap-1 min-h-[400px]" value="media-image" :tab-active="isTabActive('media-image')">
                <!--            <Label for="background.media-image">Dégradé</Label>-->
                <ImageUpload
                    id="background.media-image"
                    placeholder="Name"
                    @upload="file => image = file"
                />
            </TabsContent>

        </Tabs>
<!--        <div></div>-->
<!--        <div class="background-preview flex flex-col gap-3">-->
<!--            <Label for="background.color-gradiant">Aperçu</Label>-->
<!--            <div class="preview" v-if="value === 'color-simple'" :style="'background: ' + color + ';'" />-->
<!--            <div class="preview" v-if="value === 'color-gradient'" :style="'background: ' + gradient + ';'" />-->
<!--            <img class="preview" v-if="value === 'media-image'" :src="imageURL" alt="" />-->
<!--        </div>-->
    </div>

</template>

<style scoped>
div[data-state='active'] { display: block; }
</style>
