<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'LanguageEditModal'
});
</script>

<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import languageForm from '@/FormsDefaults/languageForm.js';
import Button from "primevue/button";
import Dialog from "primevue/dialog";

const languageStore = new useLanguageStore();

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

languageStore.setForm(languageForm);

const { showModal, openModal, doModalAction } = useModalForm(languageStore, () => languageStore.update(props.id, languageStore.getForm()));

const populateAndOpenModal = async () => {
    try {
        languageStore.updateForm(await languageStore.get(props.id))
        openModal();
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <Button class="ml-4" :label="$t('button.edit')" @click="populateAndOpenModal" />

    <Dialog v-model:visible="showModal" modal :header="$t('button.create')" :style="{ width: '50vw' }" @hide="doModalAction('cancel')">
        <LanguageForm />
        <template #footer>
            <Button severity="secondary" class="float-left" :label="$t('button.cancel')" icon="pi pi-times" @click="doModalAction('cancel')" text />
            <Button :label="$t('button.create')" icon="pi pi-check" @click="doModalAction('action')" autofocus />
        </template>
    </Dialog>
</template>

<style scoped>

</style>
