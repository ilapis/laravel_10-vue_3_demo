<script setup>
import {onMounted, ref} from "vue";
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import {useTranslationStore} from '@/Stores/translationStore.js';
import {translationTableSettings} from '@/TableSettings/translationTableSettings.js';
import TranslationCreateModal from "@/Components/Modals/TranslationCreateModal.vue";
import DataTableComponent from "@/Components/UI/DataTableComponent.vue";
import {createQueryString, initializeFilters} from "@/Helpers/filtersHelper.js";
import Button from "primevue/button";

const translationStore = new useTranslationStore();
const filters = ref({});

onMounted(async () => {
    await translationStore.fetchCollection();
    initializeFilters(translationStore, filters);
});
</script>

<template>
    <AdministrationLayout>
        <div class="w-full mt-4 height-12">
            <TranslationCreateModal/>
            <Button type="button"
                    class="ml-4"
                    @click="translationStore.fetchCollection()"
                    :label="$t('button.filter')"/>
        </div>
        <div
            class="w-full one-table-page"
        >
            <DataTableComponent
                v-if="translationStore.collection"
                :service="translationStore"
                :rows="translationStore.collection?.data"
                :filterable="translationStore.collection?.filterable"
                :sortable="translationStore.collection?.sortable"
                :row-settings="translationTableSettings"
                :pagination-links="translationStore.collection?.meta?.links"
                @update:sort="(event) => {
              if (event._sort_by) {
                  translationStore._sort_by = event._sort_by;
              }
              if (event._sort_direction) {
                  translationStore._sort_direction = event._sort_direction;
              }
              translationStore.fetchCollection();
          }"
                @update:filter="(event) => {
             translationStore._setFilters = createQueryString(translationStore.collection?.filterable, event._setFilters);
          }"
            />
        </div>
    </AdministrationLayout>
</template>

<style scoped>

</style>
