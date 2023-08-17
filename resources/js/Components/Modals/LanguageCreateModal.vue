<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'LanguageCreateModal'
});
</script>

<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import languageForm from '@/FormsDefaults/languageForm.js';
import Button from "primevue/button";
import Dialog from 'primevue/dialog';

const languageStore = new useLanguageStore();

languageStore.setForm(languageForm);

const { showModal, doModalAction } = useModalForm(languageStore, () => languageStore.create(languageStore.getForm()));
</script>

<template>
    <Button class="ml-4" :label="$t('button.add')" @click="showModal = true" />

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
