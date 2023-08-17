<script setup>
import {onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import {useArticleStore} from '@/Stores/articleStore.js';
import {articleTableSettings} from '@/TableSettings/articleTableSettings.js';

import Button from 'primevue/button';

const router = useRouter(); // getting router instance
const articleStore = new useArticleStore();

onMounted(async () => {
    await articleStore.fetchCollection();
});
const navigateToCreateArticle = () => {
    router.push({name: 'admin-article-create'});
}

const testKey = ref(1);
</script>

<template>
  <AdministrationLayout>
    <div class="w-full mt-4 height-12">
        <Button class="ml-4" :label="$t('button.create')" @click="navigateToCreateArticle" />
    </div>
    <div
      class="w-full one-table-page"
    >
      <TableComponent
        :service="articleStore"
        :rows="articleStore.collection?.data"
        :filterable="articleStore.collection?.filterable"
        :sortable="articleStore.collection?.sortable"
        :row-settings="articleTableSettings"
        @sort="event => {
            console.log(event);
          articleStore._sort_by = event.column;
          articleStore._sort_direction = event.direction;
          articleStore.fetchCollection();
        }"
      />
    </div>
    <TablePaginationComponent
      v-if="articleStore.collection?.meta?.links"
      :links="articleStore.collection?.meta?.links"
      :service="articleStore"
    />
  </AdministrationLayout>
</template>

<style scoped>

</style>
