<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'LanguageCreateModal'
});
</script>

<script setup>
import {useLanguageStore} from '@/Stores/languageStore.js';
import languageFormDefault from '@/FormsDefaults/languageForm.js';
import LanguageForm from "@/Forms/LanguageForm.vue";
import CreateModal from "@/Components/Modals/CreateModal.vue";

const languageStore = new useLanguageStore();
</script>

<template>
    <CreateModal
        :form-component="LanguageForm"
        :form-defaults="languageFormDefault"
        :store="languageStore"
    />
</template>

<style scoped>

</style>
