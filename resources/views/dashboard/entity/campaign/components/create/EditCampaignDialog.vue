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
import {onMounted, ref} from "vue";
import {api, csrf, redirect, request} from "@shadcn/lib/utils"
import { ImageUpload } from "@shadcn/components/ui/image-upload";
import axios from "axios";
import { useToast } from "@shadcn/components/ui/toast";
import { Project } from "../../data/schema";
import { Row } from "@tanstack/vue-table";
import {Campaign} from "../display/column";

// const props = defineProps<{
//   projectId: string
// }>()

const props = defineProps<{
  row: Row<Campaign>
}>()

const campaign = props.row.original

// const { toast } = useToast()

const name = ref<string>(campaign.name)
const link = ref<string>(campaign.link)

const isComplete = () => name.value !== "" && link.value !== ""
const submit = async () => {

}

</script>

<template>
  <Dialog>
    <DialogTrigger as-child>
      <slot name="button"></slot>
    </DialogTrigger>
    <DialogContent class="sm:max-w-md">
      <DialogHeader>
        <DialogTitle>Edit campaign</DialogTitle>
<!--        <DialogDescription>-->
<!--          Anyone who has this link will be able to view this.-->
<!--        </DialogDescription>-->
      </DialogHeader>

      <form action="">
        <input name="csrf" type="hidden" :value="csrf()" />
        <div class="mb-4 space-y-3">

          <Label for="name">Campaign Name</Label>
          <Input id="name" placeholder="Name" v-model="name" />

          <Label for="link">Campaign link</Label>
          <Textarea id="description" placeholder="Enter project description..." rows="5" v-model="description" />

          <Label for="image">Image</Label>
          <ImageUpload id="image" placeholder="Name" v-model="name" />

          <Label for="link">Project URL</Label>
          <Input id="link" v-model="link" placeholder="https://project.com" />

        </div>
      </form>

      <DialogFooter class="sm:justify-between">

        <DialogClose as-child>
          <Button type="button" variant="secondary">
            Close
          </Button>
        </DialogClose>

        <Button type="button" v-if="isComplete()" @click="submit()">
          Submit
        </Button>

      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>
