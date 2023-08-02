<script setup>
import {onMounted} from "vue";
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useTranslationStore } from '@/Stores/translationStore.js';
import { translationTableSettings } from '@/TableSettings/translationTableSettings.js';
import TranslationCreateModal from "@/Components/Modals/TranslationCreateModal.vue";

const translationStore = new useTranslationStore();

onMounted( async () => {
    await translationStore.fetchCollection();
});
</script>

<template>
  <AdministrationLayout>
    <div class="w-full mt-4 height-12">
      <TranslationCreateModal />
    </div>
    <div
      class="w-full one-table-page"
    >
      <TableComponent
        :service="translationStore"
        :rows="translationStore.collection?.data"
        :row-settings="translationTableSettings"
      />
    </div>
    <TablePaginationComponent
      v-if="translationStore.collection?.meta?.links"
      :links="translationStore.collection?.meta?.links"
      :service="translationStore"
    />
  </AdministrationLayout>
</template>

<style scoped>

</style>
