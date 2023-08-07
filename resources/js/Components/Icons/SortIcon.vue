<script setup>
import { ref } from 'vue';

const emit = defineEmits(['sort']);

const order = ref(null);

const setOrder = (newOrder) => {
    order.value = newOrder;
    emit('sort', newOrder);
};

const props = defineProps({
    sorted: {
        type: Boolean,
        default: false
    },
});
</script>

<template>
  <svg
    height="24px"
    viewBox="0 0 1792 1792"
    width="24px"
    xmlns="http://www.w3.org/2000/svg"
  >
    <template v-if="!props.sorted || order === null">
      <path
        class="up cursor-pointer"
        fill="grey"
        d="M1408 704q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z"
        @click="setOrder('1')"
      />
      <path
        class="down cursor-pointer"
        fill="grey"
        d="M1408 1088q0 26-19 45l-448 448q-19 19-45 19t-45-19l-448-448q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45z"
        @click="setOrder('-1')"
      />
    </template>
    <template v-if="props.sorted && order == '1'">
      <path
        class="up cursor-pointer"
        fill="black"
        d="M1408 704q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z"
        @click="setOrder('1')"
      />
      <path
        class="down cursor-pointer"
        fill="grey"
        d="M1408 1088q0 26-19 45l-448 448q-19 19-45 19t-45-19l-448-448q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45z"
        @click="setOrder('-1')"
      />
    </template>
    <template v-if="props.sorted && order == '-1'">
      <path
        class="up cursor-pointer"
        fill="grey"
        d="M1408 704q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z"
        @click="setOrder('1')"
      />
      <path
        class="down cursor-pointer"
        fill="black"
        d="M1408 1088q0 26-19 45l-448 448q-19 19-45 19t-45-19l-448-448q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45z"
        @click="setOrder('-1')"
      />
    </template>
  </svg>
</template>

<style scoped>

</style>
