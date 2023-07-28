<script setup>
import {onMounted} from "vue";
import {useLanguageStore} from '@/Stores/languageStore.js';

const languageStore = new useLanguageStore();

//const fetchLanguages = async () => {
//    await languageStore.fetchCollection();
//};

onMounted(async () => {
    //fetchLanguages();
    await languageStore.fetchCollection();
});
const props = defineProps({
    translationStore: Object,
    form: Object,
})
</script>

<template>
  <div>
    <br>
    <InputSelect
      v-model="form.language_id"
      class="mt-4"
      label="Language"
      :options="languageStore?.collection?.data"
      identifier="id"
      display="name"
    />

    <InputText
      v-model="form.group"
      label="Group"
      :underline-text="['The group field is required.']"
      :errors="translationStore?.errors?.group"
    />

    <InputText
      v-model="form.key"
      label="Key"
      :underline-text="['The key field is required.']"
      :errors="translationStore?.errors?.key"
    />

    <InputText
      v-model="form.value"
      label="Value"
      :underline-text="['The value field is required.']"
      :errors="translationStore?.errors?.name"
    />
  </div>
</template>

<style scoped>

</style>
