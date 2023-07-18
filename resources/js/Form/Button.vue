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
});

const emit = defineEmits(['click']);

const onClick = (event) => {
    emit('click', event);
};
</script>

<template>
    <div class="w-full mt-4">
        <button @click="onClick" class="button border-none float-right">{{ label }}</button>
    </div>
</template>
