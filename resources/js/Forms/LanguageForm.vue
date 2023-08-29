<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js';
const languageStore = new useLanguageStore();

let localForm = languageStore.getForm();
</script>

<template>
  <div>
    <InputText
      v-model="localForm.code"
      label="Code"
      :underline-text="['The Code field is required.']"
      :errors="languageStore?.errors?.code"
    />

    <InputText
      v-model="localForm.name"
      label="Language"
      :underline-text="['The Language field is required.']"
      :errors="languageStore?.errors?.name"
    />

    <InputCheckbox
      v-model="localForm.enabled"
      label="Enabled"
      :underline-text="['']"
      :errors="languageStore?.errors?.enabled"
    />
  </div>
</template>
