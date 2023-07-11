<script>
export default {
    setup() {

    }
}
</script>

<script setup>
  import {ref} from "vue";

  const name = ref('Jonas')
</script>

<template>
  <h1> Hello, VueJs3 with Laravel 10 ! {{name}}</h1>
</template>
