<script setup>
import {defineEmits, onMounted, onUnmounted, ref} from "vue";
import SortIcon from "@/Components/Icons/SortIcon.vue";

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
      type: Object,
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

const setTableBodyHeight = () => {
    const tableBody = document.getElementById(tableBodyId.value);
    if (tableBody) {
        tableBody.style.height = window.innerHeight - 302 + "px";
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

function sortColumn(column, direction) {
    emit('sort', { column, direction });
}
</script>


<template>
  <div
    class="w-full table-height"
  >
    <table
      class="w-full table-height"
    >
      <thead>
        <tr class="line-height-4rem text-indent-1rem text-align-left">
          <template
            v-for="(header, index) in rowSettings"
            :key="index"
          >
            <th
              class="height-12"
              :style="'width:'+`${header?.width}`+';'"
            >
              <template v-if="header.type !== 'component'">
                {{ $t('table.' + (header?.title ?? header?.column)) }}
              </template>
              <div
                v-if="props.sortable?.includes(header?.column)"
                class="sort-option"
              >
                <SortIcon
                  :sorted="props.service._sort_by == header?.column"
                  @sort="value => {sortColumn(header?.column, value);}"
                />
              </div>
            </th>
          </template>
        </tr>
      </thead>
      <tbody
        :id="tableBodyId"
        class="w-full"
      >
        <tr
          v-for="row in rows"
          :key="row.id"
          class="line-height-4rem text-indent-1rem text-align-left bg-hover-grey"
        >
          <template
            v-for="(header, index) in rowSettings"
            :key="index"
          >
            <td
              class=" height-12"
              :style="'width:'+`${header?.width}`+';'"
            >
              <component
                :is="header.component"
                v-if="header?.type == 'component'"
                :id="row.id"
                :service="props.service"
              />
              <template v-else>
                {{ row[header.column] }}
              </template>
            </td>
          </template>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
.table-height {
    height:calc(100% - 8rem);
}
.sort-option {
    float: right;
    width: 24px;
    margin-top: 4px;
    right: 16px;
    position: relative;
    background: transparent;
}
</style>
