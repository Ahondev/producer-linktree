<script setup lang="ts">
import { type Table } from '@tanstack/vue-table'

import CreateDialog from "../create/CreateCampaignDialog.vue";
import { PlusIcon } from "@radix-icons/vue";
import { Button } from "@shadcn/components/ui/button";
import { Contact } from "./column";

const emit = defineEmits(["refresh"])

interface DataTableToolbarProps {
  table: Table<Contact>
}

const props = defineProps<DataTableToolbarProps>()

const refreshTable = () => { emit("refresh") }

</script>

<template>
  <div class="flex items-center justify-between">
    <div class="flex flex-1 items-center space-x-2">
      <CreateDialog @refresh="refreshTable()">
        <template #button>
          <Button>
            <PlusIcon class="mr-2"/>
            Ajouter une campagne
          </Button>
        </template>
      </CreateDialog>
    </div>
  </div>
</template>
