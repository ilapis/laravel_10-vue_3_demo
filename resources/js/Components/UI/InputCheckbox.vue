<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputCheckbox'
});
</script>

<script setup>
import {defineProps, ref, defineEmits} from "vue";
import {sharedInputProps} from '@/Helpers/sharedInputProps.js';
import CheckboxEmptyIcon from "@/Components/Icons/CheckboxEmptyIcon.vue";
import CheckboxCheckedFilledIcon from "@/Components/Icons/CheckboxCheckedFilledIcon.vue";

const props = defineProps(sharedInputProps);
const emit = defineEmits(['update:modelValue']);
const inputValue = ref(props.modelValue || props.checked);

const toggleInputValueTo = (checked) => {
    inputValue.value = checked;
    emit('update:modelValue', inputValue.value);
};
const toggleInputValue = () => {
    inputValue.value = !inputValue.value;
    emit('update:modelValue', inputValue.value);
};
</script>

<template>
  <div class="w-full mt-4 indent-0">
    <template v-if="inputValue">
      <CheckboxCheckedFilledIcon
        class="absolute"
        style="margin-left: -3px;"
        @click="toggleInputValueTo(false)"
      />
    </template>

    <template v-else>
      <CheckboxEmptyIcon
        class="absolute"
        style="margin-left: -3px;"
        @click="toggleInputValueTo(true)"
      />
    </template>

    <label
      class="float-left ml-10 cursor-pointer"
      @click="toggleInputValue"
    >{{ props.label }}</label>

    <UnderlineComponent
      :underline-text="props.underlineText"
      :errors="props.errors"
    />
  </div>
</template>
