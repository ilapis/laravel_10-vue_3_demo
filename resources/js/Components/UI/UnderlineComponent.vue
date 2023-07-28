<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'UnderlineComponent'
});
</script>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    underlineText: {
        type: Array,
        default: null
    },
    errors: {
        type: Array,
        default: null
    },
});
</script>

<template>
  <div class="w-full block small-text">
    <template v-if="props.errors">
      <span
        v-for="(error, index) in props.errors"
        :key="index"
        class="error"
      >
        {{ error }}
      </span>
    </template>
    <template v-else>
      <span
        v-for="(text, index) in props.underlineText"
        :key="index"
        class="no-error"
      >
        {{ text }}
      </span>
    </template>
  </div>
</template>
