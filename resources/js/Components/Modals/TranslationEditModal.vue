<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'TranslationEditModal'
});
</script>

<script setup>
import {defineProps} from "vue";
import translationFormDefault from '@/FormsDefaults/translationForm.js';
import TranslationForm from "@/Forms/TranslationForm.vue";
import {useTranslationStore} from '@/Stores/translationStore.js';
import {editModalProps} from "@/Helpers/editModalProps.js";
import EditModal from "@/Components/Modals/EditModal.vue";

const props = defineProps({...editModalProps});
const translationStore = new useTranslationStore();
</script>

<template>
    <EditModal
        :id="props.id"
        :form-component="TranslationForm"
        :form-defaults="translationFormDefault"
        :store="translationStore"
        :data="props.data"
    />
</template>

<style scoped>

</style>
