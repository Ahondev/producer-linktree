<template>
    <Application>
      <DataTable :columns="columns" :data="data" @refresh="refreshData()" />
    </Application>
</template>

<script setup lang="ts">

import Application from "../../layout/Application.vue";
import DataTable from "./components/display/DataTable.vue";

import { ref, onMounted, h } from 'vue'
import {Campaign, columns, Contact} from "./components/display/column"
import type { Review } from './components/display/column';

import { api, request} from "@/lib/utils";
import axios from "axios";

const data = ref<Campaign[]>([])

async function getData(): Promise<Campaign[]> {
  const response = await request(axios.get, api("campaign/all"))
  return response.data
}

const refreshData = async () => { data.value = await getData(); }

onMounted(async () => { await refreshData(); });

</script>
