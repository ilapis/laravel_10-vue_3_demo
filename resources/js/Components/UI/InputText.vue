<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputText'
});
</script>

<script setup>
import { defineProps, defineEmits } from "vue";
import { sharedInputProps } from '@/Helpers/sharedInputProps.js';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['update:modelValue', 'validate-with-dry-request']);

const updateInputValue = (event) => {
    emit('update:modelValue', event.target.value);
    if (props.validateWithDryRequest) {
        emit('validate-with-dry-request', event.target.value);
    }
};
</script>

<template>
  <div class="w-full mt-4">
    <label class="block">{{ $t(props.label) }}</label>
    <input
      type="text"
      :value="props.modelValue"
      autocomplete="new-password"
      class="w-full border-bottom"
      @input="updateInputValue"
    >

    <UnderlineComponent
      :underline-text="props.underlineText"
      :errors="props.errors"
    />
  </div>
</template>
