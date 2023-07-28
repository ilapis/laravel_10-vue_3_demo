<script setup>
import { onMounted } from 'vue'
import { useTranslationStore } from '@/Stores/translationStore.js'
import { useLanguageStore } from '@/Stores/languageStore.js'

const translationStore = new useTranslationStore();
const languageStore = new useLanguageStore()

onMounted(async () => {
    await languageStore.fetchCollection()
})

let localForm = translationStore.getForm();
</script>

<template>
  <div>
    <br>
    <InputSelect
      v-model="localForm.language_id"
      class="mt-4"
      label="Language"
      :options="languageStore?.collection?.data"
      identifier="id"
      display="name"
    />

    <InputText
      v-model="localForm.group"
      label="Group"
      :underline-text="['The group field is required.']"
      :errors="translationStore?.errors?.group"
    />

    <InputText
      v-model="localForm.key"
      label="Key"
      :underline-text="['The key field is required.']"
      :errors="translationStore?.errors?.key"
    />

    <InputText
      v-model="localForm.value"
      label="Value"
      :underline-text="['The value field is required.']"
      :errors="translationStore?.errors?.value"
    />
  </div>
</template>

<style scoped>

</style>
