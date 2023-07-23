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
        default: ''
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
            <span class="error" v-for="(error, index) in props.errors" :key="index">
                {{error}}
            </span>
          </template>
          <template v-else>
            <span v-for="(text, index) in props.underlineText" :key="index">
                {{text}}
            </span>
          </template>
    </div>
</template>
