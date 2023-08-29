<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'LanguageEditModal'
});
</script>

<script setup>
import {defineProps} from "vue";
import languageFormDefault from '@/FormsDefaults/languageForm.js';
import {useLanguageStore} from '@/Stores/languageStore.js';
import LanguageForm from "@/Forms/LanguageForm.vue";
import {editModalProps} from "@/Helpers/editModalProps.js";
import EditModal from "@/Components/Modals/EditModal.vue";

const props = defineProps({...editModalProps});
const languageStore = new useLanguageStore();
</script>

<template>
    <EditModal
        :id="props.id"
        :form-component="LanguageForm"
        :form-defaults="languageFormDefault"
        :store="languageStore"
        :data="props.data"
    />
</template>

<style scoped>

</style>
