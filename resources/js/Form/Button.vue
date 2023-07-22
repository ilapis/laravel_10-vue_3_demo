<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'Button'
});
</script>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    type: {
        type: String,
        default: 'btn-primary'
    },
});

const emit = defineEmits(['click']);

const onClick = (event) => {
    emit('click', event);
};
</script>

<template>
    <button @click="onClick" :class="[type]" class="btn button border-none box-shadow-6">{{ label }}</button>
</template>
