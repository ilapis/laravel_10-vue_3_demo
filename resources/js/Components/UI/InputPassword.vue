<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputText'
});
</script>

<script setup>
import { defineProps, ref, defineEmits } from "vue";
import { sharedInputProps } from '@/Helpers/sharedInputProps.js';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['update:modelValue']);
const inputValue = ref(props.modelValue);

const updateInputValue = (event) => {
    inputValue.value = event.target.value;
    emit('update:modelValue', inputValue.value);
};
</script>

<template>
    <div class="w-full mt-4">
        <label class="block">{{props.label}}</label>
        <input type="password" :value="inputValue" @input="updateInputValue" autocomplete="off" class="w-full border-bottom" />

        <UnderlineComponent
            :underlineText="props.underlineText"
            :errors="props.errors"
        />
    </div>
</template>
