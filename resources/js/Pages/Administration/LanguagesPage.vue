<script setup>
import {onMounted} from "vue";
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import { useLanguageStore } from '@/Stores/languageStore.js';
import { languageTableSettings } from '@/TableSettings/languageTableSettings.js';
import DataTableComponent from "@/Components/UI/DataTableComponent.vue";

const languageStore = new useLanguageStore();

onMounted( async () => {
    await languageStore.fetchCollection();
});
</script>

<template>
  <AdministrationLayout>
    <div class="w-full mt-4 height-12">
      <LanguageCreateModal />
    </div>
    <div
      class="w-full one-table-page"
    >
        <DataTableComponent
            v-if="languageStore.collection"
            :service="languageStore"
            :rows="languageStore.collection?.data"
            :filterable="languageStore.collection?.filterable"
            :sortable="languageStore.collection?.sortable"
            :row-settings="languageTableSettings"
            :pagination-links="languageStore.collection?.meta?.links"
            @update:service="(event) => {
          languageStore._sort_by = event._sort_by;
          languageStore._sort_direction = event._sort_direction;
          languageStore.fetchCollection();
        }"
        />
    </div>
  </AdministrationLayout>
</template>

<style scoped>

</style>
