<script setup>
import { ref, watchEffect, onMounted } from 'vue'
import { useLanguageStore } from '@/Stores/languageStore.js'
import { defineProps, defineEmits } from "vue"

const languageStore = new useLanguageStore()

onMounted(async () => {
    await languageStore.fetchCollection()
})

const props = defineProps({
    translationStore: { type: Object, default: () => ({}) },
    form: { type: Object, default: () => ({}) },
})

const emit = defineEmits(['update:form'])

let localForm = ref({ ...props.form })

watchEffect(() => {
    localForm.value = { ...props.form }
})

watchEffect(() => {
    emit('update:form', localForm.value)
})
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
