<script setup lang="ts">
import type { Row } from '@tanstack/vue-table'
import { computed } from 'vue'
// import { labels } from '../data/data'
import { type Review } from '../../data/schema'
import { DotsHorizontalIcon } from '@radix-icons/vue'

import { Button } from '@shadcn/components/ui/button'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuRadioGroup,
  DropdownMenuRadioItem,
  DropdownMenuSeparator,
  DropdownMenuShortcut,
  DropdownMenuSub,
  DropdownMenuSubContent,
  DropdownMenuSubTrigger,
  DropdownMenuTrigger,
} from '@shadcn/components/ui/dropdown-menu'
import {api, redirect, request} from "@/lib/utils";
import axios from "axios";
import { useToast } from "@shadcn/components/ui/toast";
import EditDialog from "../create/EditCampaignDialog.vue";

const { toast } = useToast()

interface DataTableRowActionsProps {
  row: Row<Review>
}
const props = defineProps<DataTableRowActionsProps>()

const emit = defineEmits(['refresh'])

const openEditDialog = () => {
  const dialogTrigger = <HTMLButtonElement> document.querySelector(`#edit-contact-dialog-trigger-${props.row.original.id}`)
  dialogTrigger.click()
}

const del = async () => {

  const id = props.row.original.id
  const name = props.row.original.name

  const response = await request(axios.delete, api(`campaign/${id}`))

  if (response.status !== 200) {
    toast({
      title: 'Error',
      description: 'An error occured while deleting campaign',
    })
  } else {
    emit("refresh")
    toast({
      title: 'Success',
      description: `Campaign '${name}' removed successfully`,
    })
  }

}

</script>

<template>

  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button
          variant="ghost"
          class="flex h-8 w-8 p-0 data-[state=open]:bg-muted"
      >
        <DotsHorizontalIcon class="h-4 w-4" />
        <span class="sr-only">Open menu</span>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end" class="w-[160px]">

<!--      <DropdownMenuItem v-if="props.row.original.featured === 0" @click="setFeatured(true)">Mark as featured</DropdownMenuItem>-->
<!--      <DropdownMenuItem v-else @click="setFeatured(false)">Unmark as featured</DropdownMenuItem>-->

<!--      <DropdownMenuSeparator />-->
      <DropdownMenuItem @click="redirect('/dashboard/campaigns/' + props.row.original.link)">Modifier</DropdownMenuItem>
      <DropdownMenuItem @click="del()">
        Supprimer
        <DropdownMenuShortcut>⌘⌫</DropdownMenuShortcut>
      </DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>

  <EditDialog :row="row">
    <template #button>
      <Button class="hidden" :id="`edit-contact-dialog-trigger-${props.row.original.id}`"></Button>
    </template>
  </EditDialog>

</template>
