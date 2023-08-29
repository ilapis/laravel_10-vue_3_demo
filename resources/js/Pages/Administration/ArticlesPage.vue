<script setup>
import {onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import {useArticleStore} from '@/Stores/articleStore.js';
import {articleTableSettings} from '@/TableSettings/articleTableSettings.js';
import DataTableComponent from "@/Components/UI/DataTableComponent.vue";

import Button from 'primevue/button';

const router = useRouter(); // getting router instance
const articleStore = new useArticleStore();

onMounted(async () => {
    await articleStore.fetchCollection();
});
const navigateToCreateArticle = () => {
    router.push({name: 'admin-article-create'});
}
</script>

<template>
  <AdministrationLayout>
    <div class="w-full mt-4 height-12">
        <Button class="ml-4" :label="$t('button.create')" @click="navigateToCreateArticle" />
    </div>
    <div
      class="w-full one-table-page"
    >
        <DataTableComponent
            v-if="articleStore.collection"
            :service="articleStore"
            :rows="articleStore.collection?.data"
            :filterable="articleStore.collection?.filterable"
            :sortable="articleStore.collection?.sortable"
            :row-settings="articleTableSettings"
            :pagination-links="articleStore.collection?.meta?.links"
            @update:service="(event) => {
          articleStore._sort_by = event._sort_by;
          articleStore._sort_direction = event._sort_direction;
          articleStore._sort_direction = event._sort_direction;
          articleStore.fetchCollection();
        }"
        />
    </div>
  </AdministrationLayout>
</template>

<style scoped>

</style>
