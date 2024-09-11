<script setup lang="ts">

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

import { Button } from "@shadcn/components/ui/button";
import { Label } from "@shadcn/components/ui/label";
import { Input } from "@shadcn/components/ui/input";
import { Textarea } from "@shadcn/components/ui/textarea";
import { onMounted, ref, nextTick } from "vue";
import { api, asFormData, csrf, redirect, request } from "@shadcn/lib/utils"
import { ImageUpload } from "@shadcn/components/ui/image-upload";
import axios from "axios";
import { useToast } from "@shadcn/components/ui/toast";
import { boolean } from "zod";

const { toast } = useToast()

const props = defineProps({
  isAutonomous: {
    type: boolean,
    default: false
  }
})

const emit = defineEmits(["refresh"])

const name = ref<string>('')
const link = ref<string>('')

const appDomain = env.APP_DOMAIN
const prefixElement = ref<HTMLElement>(null)
const prefixWidth = ref<string>('0px')

const isComplete = () => name.value !== "" && link.value !== ""
const submit = async () => {

  const response = await request(axios.post, api("campaign"), asFormData({
      name: name.value,
      link: link.value,
  }))

  if (response.status !== 200) {
    toast({
      title: 'Error',
      description: 'An error occured while creating campaign',
    })
  } else {
    if(props.isAutonomous) { redirect("/dashboard/campaigns") }
    else {

      const closeTrigger = <HTMLButtonElement> document.querySelector("#create-campaign-dialog-close-trigger")
      closeTrigger.click()

      emit("refresh")
      toast({
        title: 'Success',
        description: `Campaign '${name.value}' created successfully`,
      })

    }
  }

}

const updatePrefixWidth = () => { nextTick(() => {
    prefixWidth.value = `${prefixElement.value.offsetWidth}px`
}) }

const focusLinkInput = () => { document.querySelector('#link').focus() }

</script>

<template>
  <Dialog @update:open="updatePrefixWidth()">
    <DialogTrigger as-child>
      <slot name="button"></slot>
    </DialogTrigger>
    <DialogContent class="sm:max-w-md">
      <DialogHeader>
        <DialogTitle>Créer une nouvelle campagne</DialogTitle>
        <DialogDescription>

        </DialogDescription>
      </DialogHeader>

      <form action="">
        <input name="csrf" type="hidden" :value="csrf()" />
        <div class="mb-4 space-y-3">

          <Label for="name">Nom de la campagne</Label>
          <Input id="name" placeholder="Nom de la campagne" v-model="name" />

            <Label for="link">URL de la campagne</Label>
            <div class="relative w-full max-w-sm items-center" :style="`--prefix-width: ${prefixWidth};`">
              <Input id="link" class="prefix" v-model="link" />
              <span
                  class="absolute start-1 inset-y-0 flex items-center justify-center px-2 text-muted-foreground text-sm"
                  id="link-prefix"
                  ref="prefixElement"
                  @click="focusLinkInput()"
              >
                {{ `${appDomain}/` }}
              </span>
          </div>

        </div>
      </form>

      <DialogFooter class="sm:justify-between">

        <DialogClose as-child>
          <Button type="button" variant="secondary" id="create-campaign-dialog-close-trigger">
            Annuler
          </Button>
        </DialogClose>

        <Button type="button" v-if="isComplete()" @click="submit()">
          Envoyer
        </Button>

      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>

<style scoped>
#link {
    padding-left: calc(var(--prefix-width) - 5px);
}
#link-prefix {
    cursor: text;
}
</style>
