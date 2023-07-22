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
    inputValue.value = event.target.checked;
    emit('update:modelValue', inputValue.value);
};
</script>

<template>
    <div class="w-full mt-4 indent-0">
        <input v-if="inputValue" type="checkbox" checked @change="updateInputValue"/>
        <input v-else type="checkbox" @change="updateInputValue"/>
        <label class="float-left ml-4">{{props.label}}</label>
        <span class="checkbox-underline w-full display-block small-text">
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
