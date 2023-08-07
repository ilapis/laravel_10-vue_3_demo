<script setup>
import {onMounted} from "vue";
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useLanguageStore } from '@/Stores/languageStore.js';
import { languageTableSettings } from '@/TableSettings/languageTableSettings.js';

const languageStore = new useLanguageStore();

onMounted( async () => {
    await languageStore.fetchCollection();
});
</script>

<template>
  <AdministrationLayout>
    <div class="w-full my-4 height-12">
      <LanguageCreateModal />
    </div>
    <div
      class="w-full one-table-page"
    >
      <TableComponent
        :service="languageStore"
        :rows="languageStore.collection?.data"
        :filterable="languageStore.collection?.filterable"
        :sortable="languageStore.collection?.sortable"
        :row-settings="languageTableSettings"
        @sort="event => {
          languageStore._sort_by = event.column;
          languageStore._sort_direction = event.direction;
          languageStore.fetchCollection();
        }"
      />
    </div>
    <TablePaginationComponent
      v-if="languageStore.collection?.meta?.links"
      :links="languageStore.collection?.meta?.links"
      :service="languageStore"
    />
  </AdministrationLayout>
</template>

<style scoped>

</style>
