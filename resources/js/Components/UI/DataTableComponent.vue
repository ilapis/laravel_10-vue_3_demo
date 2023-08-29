<template>
  <div>
    <TableComponent
      :service="props.service"
      :rows="props.rows"
      :filterable="props.filterable"
      :sortable="props.sortable"
      :row-settings="props.rowSettings"
      @sort="event => onSort(event)"
      @filter="event => onFilter(event)"
    />
    <TablePaginationComponent
      v-if="props.paginationLinks"
      :links="props.paginationLinks"
      :service="props.service"
    />
  </div>
</template>

<script setup>
import TableComponent from "@/Components/UI/TableComponent.vue";
import {defineProps, defineEmits} from "vue";

const props = defineProps({
    service: {type: Object, default: null},
    rows: {type: Array, default: null},
    filterable: {type: Object, default: null},
    sortable: {type: Array, default: null},
    rowSettings: {type: Object, default: null},
    paginationLinks: {type: Object, default: null},
});

const emit = defineEmits(['update:service']);

const onSort = (event) => {
    //console.log('36', event);
    const updatedService = { _sort_by: event.column, _sort_direction: event.direction };
    emit('update:service', updatedService);
    emit('update:sort', updatedService);
};
const onFilter = (event) => {
    //console.log('41', event);
    const updatedService = { _setFilters: event };
    emit('update:filter', updatedService);
};
</script>
