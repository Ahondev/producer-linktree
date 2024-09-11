<script setup lang="ts">
import {type HTMLAttributes, computed, onMounted, nextTick, getCurrentInstance, ref} from 'vue'
import { TabsTrigger, type TabsTriggerProps, useForwardProps } from 'radix-vue'
import { cn } from '@/lib/utils'

const props = defineProps<TabsTriggerProps & { class?: HTMLAttributes['class'], isDefault?: boolean }>()

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})

const forwardedProps = useForwardProps(delegatedProps)
const instance = getCurrentInstance()
const reset = ref<boolean>(true)

const resetDefault = () => {
    const parentElement = instance.proxy.$parent.$el
    const triggerButtons = parentElement.querySelectorAll('button')
    triggerButtons.forEach(button => { button.classList.remove('is-default') })
    reset.value = false
}

</script>

<template>
  <TabsTrigger
    v-bind="forwardedProps"
    :class="cn(
      'inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow',
      props.class,
      isDefault ? 'is-default': ''
    )"
    @click="reset ? resetDefault() : null"
  >
    <span class="truncate">
      <slot />
    </span>
  </TabsTrigger>
</template>

<style scoped lang="scss">
button[tabindex='0'], button.is-default {
    --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);
    --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
    box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow);
    background-color: hsl(var(--background));
    color: hsl(var(--foreground));
}
</style>
