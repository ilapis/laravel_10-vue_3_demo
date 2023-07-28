<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';

const languageStore = new useLanguageStore();

languageStore.setForm({
    code: '',
    name: '',
    enabled: false
});

const { showModal, openModal, doModalAction } = useModalForm(languageStore, languageStore.getForm(), () => languageStore.create(languageStore.getForm()));
</script>

<template>
    <ButtonComponent class="btn btn-primary height-12 ml-4 box-shadow" @click="openModal" label="Add" />
    <ModalComponent
        :show="showModal"
        actionLabel="Create"
        @update:show="showModal = $event"
        @update:action="doModalAction($event)" >

        <LanguageForm
            :languageStore="languageStore"
            :form="languageStore.getForm()"
        />
    </ModalComponent>
</template>

<style scoped>

</style>
