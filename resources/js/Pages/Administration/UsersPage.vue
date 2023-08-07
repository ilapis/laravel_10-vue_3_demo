<script setup>
import {onMounted} from "vue";
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useUserStore } from '@/Stores/userStore.js';
import {userTableSettings} from "@/TableSettings/userTableSettings.js";

const userStore = new useUserStore();

onMounted( async () => {
    await userStore.fetchCollection();
});
</script>

<template>
  <AdministrationLayout>
    <div class="w-full my-4 height-12">
      <UserCreateModal />
    </div>
    <div
      class="w-full one-table-page"
    >
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
  </AdministrationLayout>
</template>

<style scoped>

</style>
