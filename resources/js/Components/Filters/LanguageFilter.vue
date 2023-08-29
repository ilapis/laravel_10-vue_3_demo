<script setup>
import {defineEmits, ref, watch} from "vue";
import { useLanguageStore } from '@/Stores/languageStore.js';
const languageStore = new useLanguageStore();

const emit = defineEmits(['change']);
const props = defineProps( {
    value: {
        type: [String, Number],
        default: null,
    },
    modelValue: {
        type: [String, Number],
        default: null,
    },
});
const languageModel = ref(props.modelValue);
watch(languageModel, (newVal, oldVal) => {
    emit('update:modelValue', newVal);
    emit('change', newVal);
});

</script>

<template>
    <div style="margin-top:-1rem">
    <InputSelect
        v-model="languageModel"
        :value="languageModel"
        :options="languageStore.enabled"
        identifier="name"
        display="name"
    />
    </div>
</template>

<style scoped>

</style>
