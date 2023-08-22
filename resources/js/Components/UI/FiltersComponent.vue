<script setup>
import {ref, defineProps} from "vue";

// Define the props
const props = defineProps({
    filterable: {type: Object, default: null},
    filters: {type: Object, default: null},
});

// Define the emit functions
const emit = defineEmits(["update-filters"]);

const filters = ref(props.filters);
const updateFilters = () => {
    // Emit event with filters.value
    emit("update-filters", filters.value);
};
</script>

<template>
  <div
    class="inline float-right"
    style="margin-top:-1rem;"
  >
    <template
      v-for="(data, index) in props?.filterable"
      :key="index"
    >
      <template v-if="data.includes('contains')">
        <InputText
          v-model="filters[index]"
          class="float-right mr-4"
          style="width:200px;"
          :placeholder="'table.' + index.replaceAll('.', '_')"
          @input="updateFilters"
        />
      </template>
      <template v-if="data.includes('is_null')">
        <template v-if="filters[index] == null || filters[index] == false">
          <InputCheckbox
            v-model="filters[index]"
            class="float-right mr-4"
            style="width:200px;margin-top:2rem;"
            :label="'table.' + index.replaceAll('.', '_')"
            @click="updateFilters"
          />
        </template>
        <template v-if="filters[index] == true">
          <InputCheckbox
            v-model="filters[index]"
            :checked="true"
            class="float-right mr-4"
            style="width:200px;margin-top:2rem;"
            :label="'table.' + index.replaceAll('.', '_')"
            @click="updateFilters"
          />
        </template>
      </template>
    </template>
  </div>
</template>

<style scoped>
/* Your styles here */
</style>
