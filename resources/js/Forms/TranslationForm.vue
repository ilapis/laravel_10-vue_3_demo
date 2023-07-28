<script setup>
import {onMounted} from "vue";
import {useLanguageStore} from '@/Stores/languageStore.js';

const languageStore = new useLanguageStore();

const fetchLanguages = async () => {
    await languageStore.fetchLanguages();
};

onMounted(() => {
    fetchLanguages();
});
const props = defineProps({
    translationStore: Object,
    form: Object,
})
</script>

<template>
        <div>
            <br/>
            <InputSelect
                class="mt-4"
                label="Language"
                :options="languageStore?.collection?.data"
                v-model="form.language_id"
                identifier="id" display="name"
            />

            <InputText
                label="Group"
                :underlineText="['The group field is required.']"
                :errors="translationStore?.errors?.group"
                v-model="form.group"
            />

            <InputText
                label="Key"
                :underlineText="['The key field is required.']"
                :errors="translationStore?.errors?.key"
                v-model="form.key"
            />

            <InputText
                label="Value"
                :underlineText="['The value field is required.']"
                :errors="translationStore?.errors?.name"
                v-model="form.value"
            />
        </div>
</template>

<style scoped>

</style>
