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
  <button
    class="btn border-none box-shadow"
    @click="onClick"
  >
    <template v-if="isNaN(label)">
      {{ $t('button.' + label.toLowerCase()) }}
    </template>
    <template v-else>
      {{ label }}
    </template>
    <slot />
  </button>
</template>
