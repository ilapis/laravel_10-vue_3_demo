<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputText'
});
</script>

<script setup>
import { defineProps, defineEmits } from "vue";
import { sharedInputProps } from '@/Helpers/sharedInputProps.js';
import InputText from 'primevue/inputtext';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['update:modelValue', 'validate-with-dry-request']);

const updateInputValue = (value) => {
    console.log(value);
    emit('update:modelValue', value);
    if (props.validateWithDryRequest) {
        emit('validate-with-dry-request', value);
    }
};
</script>

<template>
  <div class="w-full mt-4">
    <label class="block">{{ $t(props.label) }}</label>
      <InputText v-model="props.modelValue" @update:model-value="updateInputValue" />
      <UnderlineComponent :underline-text="props.underlineText" :errors="props.errors" />
  </div>
</template>
