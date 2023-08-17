<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'TranslationEditModal'
});
</script>

<script setup>
import { useTranslationStore } from '@/Stores/translationStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import translationForm from '@/FormsDefaults/translationForm.js';
import Button from "primevue/button";
import Dialog from "primevue/dialog";

const translationStore = new useTranslationStore();

const props = defineProps({
    id: {
        type: Number,
        default: null
    },
    service:{
        type: Object,
        default: null
    },
})

translationStore.setForm(translationForm);

const { showModal, openModal, doModalAction } = useModalForm(translationStore, () => translationStore.update(props.id, translationStore.getForm()));

const populateAndOpenModal = async () => {
    try {
        translationStore.updateForm(await translationStore.get(props.id));
        openModal();
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <Button class="ml-4" :label="$t('button.edit')" @click="populateAndOpenModal" />

    <Dialog v-model:visible="showModal" modal :header="$t('button.create')" :style="{ width: '50vw' }" @hide="doModalAction('cancel')">
        <TranslationForm />
        <template #footer>
            <Button severity="secondary" class="float-left" :label="$t('button.cancel')" icon="pi pi-times" @click="doModalAction('cancel')" text />
            <Button :label="$t('button.create')" icon="pi pi-check" @click="doModalAction('action')" autofocus />
        </template>
    </Dialog>
</template>

<style scoped>

</style>
