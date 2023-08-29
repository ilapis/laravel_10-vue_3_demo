<script setup>
import {defineEmits, onMounted, onUnmounted, ref, watch} from "vue";

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import {FilterMatchMode} from "primevue/api";

const emit = defineEmits(['sort', 'filter']);

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

import {usePrimeVue} from "primevue/config";
const primevue = usePrimeVue();

const tableBodyId = ref("table_body_" + generateRandomId());
const tableHeight = ref("400px");

const setTableBodyHeight = () => {
    const tableBody = document.getElementById(tableBodyId.value);
    if (tableBody) {
        tableBody.style.height = window.innerHeight - 240 + "px";
        tableHeight.value = window.innerHeight - 240 + "px" ;
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

function filterRows(event) {
    emit('filter', event.filters);
}

const filters = ref({});
const updateFilters = (column, value) => {
    filters.value[column].value = value;
    emit('filter', filters.value);
}
const matchModeOptions = ref({});

const setFilterValue = (matchMode, key, value) => {
  if (filters.value[key] && value != null) {
      filters.value[key] = {
        value: value,
        matchMode: (matchMode + '').replace(/_([a-z])/g, (match, letter) => letter.toUpperCase())
      };
  }
}
const setTableFilters = (matchMode, key, value) => {
  if (filters.value[key] == null) {
      filters.value[key] = {
        value: value,
        matchMode: (matchMode + '').replace(/_([a-z])/g, (match, letter) => letter.toUpperCase())
      };
  }
}

watch(() => props.filterable, (newValue) => {
    Object.keys(props.filterable).forEach(key => {
        const matchMode = props.filterable[key];
        const queryString = props.service._setFilters;
        const params = new URLSearchParams(queryString);
        matchModeOptions.value[key] = [];

        matchMode.forEach((modeOption) => {
            let mode = modeOption.replace(/_([a-z])/g, (match, letter) => letter.toUpperCase());
            matchModeOptions.value[key].push({'label': primevue.config.locale[mode], 'value': mode});
            const nameValue = params.get(`${modeOption}[${key}]`);
            setFilterValue(modeOption, key, nameValue);
        });
    });
});

const updateLanguages = () => {
    let language = localStorage.getItem('language');
    let translations = window.i18n.global.getLocaleMessage(language);
    if (translations['primevue']) {
        primevue.config.locale = translations['primevue'];

        if (props.filterable) {
            Object.keys(props.filterable).forEach(key => {
                const matchMode = props.filterable[key];
                const queryString = props.service._setFilters;
                const params = new URLSearchParams(queryString);
                const nameValue = params.get(`${matchMode}[${key}]`);
                matchModeOptions.value[key] = [];

                matchMode.forEach((modeOption) => {
                    let mode = modeOption.replace(/_([a-z])/g, (match, letter) => letter.toUpperCase());
                    matchModeOptions.value[key].push({'label': primevue.config.locale[mode], 'value': mode});
                    setTableFilters(modeOption, key, nameValue);
                });
            });
        }
    }
}

onMounted(() => {
    updateLanguages();
});

import {emitter} from './../../utils.js';
emitter.on('language-changed', updateLanguages)
</script>


<template>
  <div
    :id="tableBodyId"
    style="overflow:auto;"
  >
    <DataTable
        v-model:filters="filters"
      lazy
      scrollable
      :loading="service._loading ?? false"
      :scroll-height="tableHeight"
      :value="props.rows"
      table-style="min-width: 50rem"
      @sort="sortColumn"
      @filter="filterRows"
      dataKey="id"
      :filterDisplay="props.filterable ? 'row' : null"
      filter-locale="en"
    >
      <template
        v-for="(header, index) in rowSettings"
        :key="index"
      >
        <Column
          :filterMatchModeOptions="matchModeOptions[header.column]"
          :header="$t(('table.' + (header?.title ?? header.column)) === 'table.undefined' ? '' : ('table.' + (header?.title ?? header.column)))"
          :field="header.column"
          :sortable="sortable?.includes(header.column)"
          :frozen="header.frozen ?? false"
          :alignFrozen="header.alignFrozen ?? 'left'"
          :style="`width: ${header.width}`"
          :filterField="header.column"
          :showFilterMenu="(props.filterable != null && props.filterable[header.column]) ? true : false"
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
          <template #filter="{ filterModel, filterCallback }">
              <template v-if="filters[header.column] && props.filterable && props.filterable[header.column]">
                  <template v-if="header.filter">
                      <component
                          :is="header.filter"
                          v-model="filters[header.column].value"
                          @change="value => updateFilters(header.column, value)"
                      />
                  </template>
                  <template v-else>
                  <InputText style="min-width:200px;" v-model="filters[header.column].value" type="text" @change="value => updateFilters(header.column, value)" class="p-column-filter" :placeholder="$t('placeholder.search')" />
                  </template>
                  <Badge :key="'primevue.' + filters[header.column]?.matchMode" class="box-shadow" :value="$t('primevue.' + filters[header.column]?.matchMode)" style="margin-left: -0.5rem;margin-top: -1.125rem;position: absolute;" />
              </template>
          </template>
        </Column>
      </template>
    </DataTable>
  </div>
</template>

<style scoped>

</style>
