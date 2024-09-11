<script setup lang="ts">
import {HTMLAttributes, onMounted, ref} from 'vue'
import { useVModel } from '@vueuse/core'
// import { Label } from "@shadcn/components/ui/label"
import { Input } from "@shadcn/components/ui/input"
import { cn } from '@/lib/utils'

const props = defineProps<{
  defaultValue?: string | number
  modelValue?: string | number
  class?: HTMLAttributes['class']
  id?: HTMLAttributes['id']
  defaultUrl: string | null
  placeholder?: HTMLAttributes['placeholder']
}>()

const emits = defineEmits<{
  (e: 'update:modelValue', payload: string | number): void
  (e: 'upload', file: File): void
}>()

const modelValue = useVModel(props, 'modelValue', emits, {
  passive: true,
  defaultValue: props.defaultValue,
})

</script>

<template>
  <div class="grid w-full items-center gap-1.5">
<!--    <Label for="picture">Picture</Label>-->
    <Input
        v-model="modelValue"
        :id="props.id ?? ''"
        :placeholder="props.placeholder ?? 'Selectionnez une image'"
        type="file"
        :class="cn('w-full', props.class ?? '')"
        @change="handleFileChange"
    />
    <img v-if="imageUrl !== null" :src="imageUrl" alt="Uploaded Image" class="mt-4 max-w-full h-auto" />
<!--    <img v-if="imageUrl !== null" src="https://images.unsplash.com/photo-1720048171527-208cb3e93192?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Uploaded Image" class="mt-4 max-w-full h-auto" />-->
  </div>
</template>

<style scoped>
input {
    cursor: pointer;
}
img {
    max-width: 50%;
    max-height: 200px;
    height: auto;
    border-radius: 0.8rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
