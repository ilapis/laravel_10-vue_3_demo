<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputSelect'
});
</script>

<script setup>
import {defineProps, ref, defineEmits, watch, computed} from "vue";
import { sharedInputProps } from '@/Helpers/sharedInputProps.js';
import Dropdown from 'primevue/dropdown';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['change', 'update:modelValue']);

const updateInputValue = () => {
    emit('update:modelValue', localModel.value);
    emit('change', localModel.value);
};

const localModel = ref( props.modelValue || props.value);
//const localModel = ref(props.value || props.modelValue);
const localOptionLabel = ref(props.display);
const localOptionValue = ref(props.identifier);

watch(() => props.value, (newValue) => {
    localModel.value = newValue;
});
watch(() => props.modelValue, (newValue) => {
    localModel.value = newValue;
});
watch(() => props.display, (newValue) => {
    localOptionLabel.value = newValue;
});
watch(() => props.identifier, (newValue) => {
    localOptionValue.value = newValue;
});
</script>

<template>
  <div
    class="select-wrapper w-full mt-4 position-relative"
  >
    <label
      v-if="props.label"
      class="w-full block float-left"
    >{{ $t(props.label) }}</label>
    <div>
      <Dropdown
        v-model="localModel"
        :options="props.options"
        :option-label="localOptionLabel"
        :option-value="localOptionValue"
        :placeholder="$t('option.select')"
        @change="updateInputValue"
      /><!--TODO TEMPLATE SELECTION-->
    </div>
    <UnderlineComponent
      :underline-text="props.underlineText"
      :errors="props.errors"
    />
  </div>
</template>

<style setup>
.position-relative {
    position: relative;
}
.select-wrapper {
    text-indent: 0;
}
</style>
