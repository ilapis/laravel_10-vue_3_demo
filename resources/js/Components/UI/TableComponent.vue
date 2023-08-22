<script setup>
import {defineEmits, onMounted, onUnmounted, ref} from "vue";

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const emit = defineEmits(['sort']);

const props = defineProps({
    rows: {
        type: Object,
        default: null
    },
    filterable: {
      type: Object,
      default: null
    },
    sortable: {
      type: Array,
      default: null
    },
    rowSettings: {
        type: Object,
        default: null
    },
    service: {
        type: Object,
        default: null
    },
});

const tableBodyId = ref("table_body_" + generateRandomId());
const tableHeight = ref("400px");

const setTableBodyHeight = () => {
    const tableBody = document.getElementById(tableBodyId.value);
    if (tableBody) {
        tableBody.style.height = window.innerHeight - 252 + "px";
        tableHeight.value = window.innerHeight - 252 + "px" ;
    }
};
onMounted( () => {
    setTableBodyHeight();
    window.addEventListener('resize', setTableBodyHeight);
});

onUnmounted( () => {
    window.removeEventListener('resize', setTableBodyHeight);
});

// Function to generate a random ID
function generateRandomId() {
    return Math.random().toString(36).substr(2, 9);
}
function sortColumn(event) {
    let column = event.sortField;
    let direction = event.sortOrder;
    emit('sort', { column, direction });
}
</script>


<template>
  <div
    :id="tableBodyId"
    style="overflow:auto;"
  >
    <DataTable
      lazy
      scrollable
      :loading="service._loading ?? false"
      :scroll-height="tableHeight"
      :value="props.rows"
      table-style="min-width: 50rem"
      @sort="sortColumn"
    >
      <template
        v-for="(header, index) in rowSettings"
        :key="index"
      >
        <Column
          :header="$t(('table.' + (header?.title ?? header.column)) === 'table.undefined' ? '' : ('table.' + (header?.title ?? header.column)))"
          :field="header.column"
          :sortable="sortable?.includes(header.column)"
          :frozen="header.frozen ?? false"
          :alignFrozen="header.alignFrozen ?? 'left'"
          :style="`width: ${header.width}`"
        >
          <template #body="{ data }">
            <template v-if="header.type === 'component'">
              <component
                :is="header.component"
                :id="data.id"
                :data="data"
                :service="props.service"
                :component_settings="header?.component_settings"
              /><!--//@TODO move all to config (id, data, service, components_settings) -->
            </template>
            <template v-else>
              {{ data[header.column] }}
            </template>
          </template>
        </Column>
      </template>
    </DataTable>
  </div>
</template>

<style scoped>

</style>
