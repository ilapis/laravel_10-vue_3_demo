<script setup>
const props = defineProps({
    languageStore: Object,
    form: Object,
})
</script>

<template>
  <div>
    <InputText
      v-model="form.code"
      label="Code"
      :underline-text="['The Code field is required.']"
      :errors="languageStore?.errors?.code"
    />

    <InputText
      v-model="form.name"
      label="Language"
      :underline-text="['The Language field is required.']"
      :errors="languageStore?.errors?.name"
    />

    <InputCheckbox
      v-model="form.enabled"
      label="Enabled"
      :underline-text="['']"
      :errors="languageStore?.errors?.enabled"
    />
  </div>
</template>

<style scoped>

</style>
