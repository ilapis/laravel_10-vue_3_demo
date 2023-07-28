<script setup>
import { ref } from 'vue'
import { defineProps, defineEmits, watchEffect } from "vue";

const props = defineProps({
    languageStore: { type: Object, default: () => ({}) },
    form: { type: Object, default: () => ({}) },
});

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
