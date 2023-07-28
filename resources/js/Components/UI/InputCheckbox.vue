<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputCheckbox'
});
</script>

<script setup>
import { defineProps, ref, defineEmits } from "vue";
import { sharedInputProps } from '@/Helpers/sharedInputProps.js';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['update:modelValue']);
const inputValue = ref(props.modelValue);

const updateInputValue = (event) => {
    inputValue.value = event.target.checked;
    emit('update:modelValue', inputValue.value);
};
</script>

<template>
  <div class="w-full mt-4 indent-0">
    <input
      v-if="inputValue"
      type="checkbox"
      checked
      @change="updateInputValue"
    >
    <input
      v-else
      type="checkbox"
      @change="updateInputValue"
    >
    <label class="float-left ml-4">{{ props.label }}</label>

    <UnderlineComponent
      :underline-text="props.underlineText"
      :errors="props.errors"
    />
  </div>
</template>
