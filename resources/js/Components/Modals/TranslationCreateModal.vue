<script setup>
import { useTranslationStore } from '@/Stores/translationStore.js';
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import translationForm from '@/FormsDefaults/translationForm.js';

const translationStore = new useTranslationStore();
const languageStore = new useLanguageStore();

translationStore.setForm(translationForm);

const { showModal, openModal, doModalAction } = useModalForm(translationStore, () => translationStore.create(translationStore.getForm()));
</script>

<template>
    <ButtonComponent class="btn btn-primary height-12 ml-4 box-shadow" @click="openModal" label="Add" />
    <ModalComponent
        :show="showModal"
        actionLabel="Create"
        @update:show="showModal = $event"
        @update:action="doModalAction($event)" >

        <TranslationForm
            :translationStore="translationStore"
            :form="translationStore.getForm()"
        />
    </ModalComponent>
</template>

<style scoped>

</style>
