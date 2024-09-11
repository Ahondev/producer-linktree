<template>
    <app-menu>
        <Menu />
    </app-menu>
    <app-content class="grid grid-cols-5">
        <Sidebar />
        <div class="content col-span-4">
            <div class="container py-10 mx-auto">
              <slot></slot>
            </div>
        </div>
    </app-content>
</template>

<script setup lang="ts">

import Menu from "./Menu.vue";
import Sidebar from "./Sidebar.vue";

</script>

<style>
app-content {
    padding-top: 48px;
}
</style>
