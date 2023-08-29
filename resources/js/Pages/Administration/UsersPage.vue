<script setup>
import {onMounted, ref} from "vue";
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import DataTableComponent from "@/Components/UI/DataTableComponent.vue";
import {useUserStore} from '@/Stores/userStore.js';
import {userTableSettings} from "@/TableSettings/userTableSettings.js";
import {createQueryString, initializeFilters} from '@/Helpers/filtersHelper.js';
import Button from "primevue/button";

const userStore = new useUserStore();
const filters = ref({});

onMounted(async () => {
  await userStore.fetchCollection();
  initializeFilters(userStore, filters);
});
</script>

<template>
  <AdministrationLayout>
    <div class="w-full mt-4 height-12">
      <UserCreateModal/>
      <Button type="button"
              class="ml-4"
              @click="userStore.fetchCollection()"
              :label="$t('button.filter')"/>
    </div>
    <div
        class="w-full one-table-page"
    >
      <DataTableComponent
          v-if="userStore.collection"
          :service="userStore"
          :rows="userStore.collection?.data"
          :filterable="userStore.collection?.filterable"
          :sortable="userStore.collection?.sortable"
          :row-settings="userTableSettings"
          :pagination-links="userStore.collection?.meta?.links"
          @update:sort="(event) => {
              if (event._sort_by) {
                  userStore._sort_by = event._sort_by;
              }
              if (event._sort_direction) {
                  userStore._sort_direction = event._sort_direction;
              }
              userStore.fetchCollection();
          }"
          @update:filter="(event) => {
             userStore._setFilters = createQueryString(userStore.collection?.filterable, event._setFilters);
          }"
      />
    </div>
  </AdministrationLayout>
</template>

<style scoped>

</style>
