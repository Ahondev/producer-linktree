<!--<script setup lang="ts">-->
<!--import {HTMLAttributes, onMounted, ref} from 'vue'-->
<!--import { useVModel } from '@vueuse/core'-->
<!--// import { Label } from "@shadcn/components/ui/label"-->
<!--import { Input } from "@shadcn/components/ui/input"-->
<!--import { cn } from '@/lib/utils'-->

<!--const props = defineProps<{-->
<!--  defaultValue?: string | number-->
<!--  modelValue?: string | number-->
<!--  class?: HTMLAttributes['class']-->
<!--  id?: HTMLAttributes['id']-->
<!--  defaultUrl: string | null-->
<!--  placeholder?: HTMLAttributes['placeholder']-->
<!--}>()-->

<!--const emits = defineEmits<{-->
<!--  (e: 'update:modelValue', payload: string | number): void-->
<!--  (e: 'upload', file: File): void-->
<!--}>()-->

<!--const modelValue = useVModel(props, 'modelValue', emits, {-->
<!--  passive: true,-->
<!--  defaultValue: props.defaultValue,-->
<!--})-->

<!--const imageUrl = ref(null);-->

<!--const handleFileChange = (event: Event) => {-->

<!--    const input = <HTMLInputElement> event.target-->
<!--    const file = <File> input.files[0]-->
<!--    if (file) {-->
<!--        imageUrl.value = URL.createObjectURL(file);-->
<!--        emits('update:modelValue', file.name);-->
<!--        emits('upload', file);-->
<!--    }-->

<!--}-->

<!--// onMounted(() => {  })-->
<!--if(props.defaultUrl !== undefined) { imageUrl.value = props.defaultUrl }-->
<!--</script>-->

<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/components/ui/tabs'
</script>

<template>
    <Tabs default-value="account" class="w-[400px]">
        <TabsList class="grid w-full grid-cols-2">
            <TabsTrigger value="account">
                Account
            </TabsTrigger>
            <TabsTrigger value="password">
                Password
            </TabsTrigger>
        </TabsList>
        <TabsContent value="account">
            <Card>
                <CardHeader>
                    <CardTitle>Account</CardTitle>
                    <CardDescription>
                        Make changes to your account here. Click save when you're done.
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-2">
                    <div class="space-y-1">
                        <Label for="name">Name</Label>
                        <Input id="name" default-value="Pedro Duarte" />
                    </div>
                    <div class="space-y-1">
                        <Label for="username">Username</Label>
                        <Input id="username" default-value="@peduarte" />
                    </div>
                </CardContent>
                <CardFooter>
                    <Button>Save changes</Button>
                </CardFooter>
            </Card>
        </TabsContent>
        <TabsContent value="password">
            <Card>
                <CardHeader>
                    <CardTitle>Password</CardTitle>
                    <CardDescription>
                        Change your password here. After saving, you'll be logged out.
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-2">
                    <div class="space-y-1">
                        <Label for="current">Current password</Label>
                        <Input id="current" type="password" />
                    </div>
                    <div class="space-y-1">
                        <Label for="new">New password</Label>
                        <Input id="new" type="password" />
                    </div>
                </CardContent>
                <CardFooter>
                    <Button>Save password</Button>
                </CardFooter>
            </Card>
        </TabsContent>
    </Tabs>
</template>

<style scoped>

</style>
