<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputText'
});
</script>

<script setup>
import { defineProps, ref, defineEmits } from "vue";

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    underlineText: {
        type: Array,
        default: ''
    },
    modelValue: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:modelValue']);
const inputValue = ref(props.modelValue);

const updateInputValue = (event) => {
    inputValue.value = event.target.value;
    emit('update:modelValue', inputValue.value);
};
</script>

<template>
    <div class="w-full mt-4">
        <label class="display-block">{{props.label}}</label>
        <input type="text" :value="inputValue" @input="updateInputValue" autocomplete="new-password" class="w-full border-bottom" />
        <span class="w-full display-block small-text">
              <template v-if="typeof props.underlineText === 'string'">
                {{props.underlineText}}
              </template>
              <template v-else-if="Array.isArray(props.underlineText)">
                <span v-for="(item, index) in props.underlineText" :key="index">
                    {{item}}
                </span>
              </template>
        </span>
    </div>
</template>
