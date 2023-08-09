<script setup>
import AdministrationLayout from '@/Layouts/AdministrationLayout.vue';
import ArticleForm from "@/Forms/ArticleForm.vue";
import { useRoute } from 'vue-router';

const route = useRoute();
const id = parseInt(route.params.id);
</script>

<template>
  <AdministrationLayout>
    <ArticleForm :id="id" />
  </AdministrationLayout>
</template>

<style scoped>

</style>
