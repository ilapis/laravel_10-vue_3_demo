<script setup>
import {onMounted, ref} from "vue";
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
//import TableComponent from "@/Components/UI/TableComponent.vue";
import DataTableComponent from "@/Components/UI/DataTableComponent.vue";
import { useUserStore } from '@/Stores/userStore.js';
import {userTableSettings} from "@/TableSettings/userTableSettings.js";
import { createQueryString, initializeFilters } from '@/Helpers/filtersHelper.js';

const userStore = new useUserStore();
const filters = ref({});

onMounted( async () => {
    await userStore.fetchCollection();
    initializeFilters(userStore, filters);
});

const updateFilters = (filters) => {
    userStore._setFilters = createQueryString(userStore.collection?.filterable, filters);
    userStore.fetchCollection();
}
</script>

<template>
  <AdministrationLayout>
    <div class="w-full mt-4 height-12">
      <UserCreateModal />
    </div>
    <div
      class="w-full one-table-page"
    ><!--
      <TableComponent
        :service="userStore"
        :rows="userStore.collection?.data"
        :filterable="userStore.collection?.filterable"
        :sortable="userStore.collection?.sortable"
        :row-settings="userTableSettings"
        @sort="event => {
          userStore._sort_by = event.column;
          userStore._sort_direction = event.direction;
          userStore.fetchCollection();
        }"
      />
    </div>
    <TablePaginationComponent
      v-if="userStore.collection?.meta?.links"
      :links="userStore.collection?.meta?.links"
      :service="userStore"
    />
-->
      <DataTableComponent
          :service="userStore"
          :rows="userStore.collection?.data"
          :filterable="userStore.collection?.filterable"
          :sortable="userStore.collection?.sortable"
          :row-settings="userTableSettings"
          :pagination-links="userStore.collection?.meta?.links"
          @update:service="(event) => {
          userStore._sort_by = event._sort_by;
          userStore._sort_direction = event._sort_direction;
          userStore.fetchCollection();
        }"
      />
      </div>
  </AdministrationLayout>
</template>

<style scoped>

</style>
