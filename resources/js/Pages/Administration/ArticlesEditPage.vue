<script setup>
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import ArticleForm from "@/Forms/ArticleForm.vue";
import { useRoute } from 'vue-router';

const route = useRoute();
</script>

<template>
  <AdministrationLayout>
    <ArticleForm :id="parseInt(route.params.id.toString())" />
  </AdministrationLayout>
</template>

<style scoped>

</style>
