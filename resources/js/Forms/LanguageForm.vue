<script setup>
const props = defineProps({
    languageStore: Object,
    form: Object,
})
</script>

<template>
    <div> {{ $t('qwerty.ccc22') }}
        <InputText
            label="Code"
            :underlineText="['The Code field is required.']"
            :errors="languageStore?.errors?.code"
            v-model="form.code"
        />

        <InputText
            label="Language"
            :underlineText="['The Language field is required.']"
            :errors="languageStore?.errors?.name"
            v-model="form.name"
        />

        <InputCheckbox
            label="Enabled"
            :underlineText="['']"
            :errors="languageStore?.errors?.enabled"
            v-model="form.enabled"
        />
    </div>
</template>

<style scoped>

</style>
