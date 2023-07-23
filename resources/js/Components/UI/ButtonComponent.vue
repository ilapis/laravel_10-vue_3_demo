<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'ButtonComponent'
});
</script>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
});

const emit = defineEmits(['click']);

const onClick = (event) => {
    emit('click', event);
};
</script>

<template>
    <button @click="onClick" class="btn button border-none box-shadow-6">{{ label }}
        <slot></slot>
    </button>
</template>
