<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'TranslationCreateModal'
});
</script>

<script setup>
import translationFormDefault from '@/FormsDefaults/translationForm.js';
import { useTranslationStore } from '@/Stores/translationStore.js';
import TranslationForm from "@/Forms/TranslationForm.vue";
import CreateModal from "@/Components/Modals/CreateModal.vue";

const translationStore = new useTranslationStore();
</script>

<template>
    <CreateModal
        :form-component="TranslationForm"
        :form-defaults="translationFormDefault"
        :store="translationStore"
    />
</template>

<style scoped>

</style>
