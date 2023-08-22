<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputCheckbox'
});
</script>

<script setup>
import {defineProps, ref, defineEmits} from "vue";
import {sharedInputProps} from '@/Helpers/sharedInputProps.js';
import Checkbox from 'primevue/checkbox';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['update:modelValue']);
const inputValue = ref(props.checked || props.modelValue);

const toggleInputValueTo = () => {
    emit('update:modelValue', inputValue.value);
};
const toggleInputValue = () => {
    inputValue.value = !inputValue.value;
    emit('update:modelValue', inputValue.value);
};
</script>

<template>
  <div
    class="block w-full indent-0"
    style="line-height: 2rem;height:2rem;"
  >
    <Checkbox
      v-model="inputValue"
      class="float-left"
      :binary="true"
      @click="toggleInputValueTo(true)"
    />
    <label
      class="float-left cursor-pointer"
      style="margin-left: 0.5rem;position: relative;top: -0.375rem;"
      @click="toggleInputValue"
    >{{ $t(props.label) }}</label>

    <UnderlineComponent
      :underline-text="props.underlineText"
      :errors="props.errors"
    />
  </div>
</template>
