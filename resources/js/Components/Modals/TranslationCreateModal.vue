<script setup>
import { useTranslationStore } from '@/Stores/translationStore.js';
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import {onMounted, ref} from "vue";

const translationStore = new useTranslationStore();
const languageStore = new useLanguageStore();

let form = ref({
    language_id: null,
    group: '',
    key: '',
    value: '',
});

const { showModal, openModal, doModalAction } = useModalForm(translationStore, form, (form) => translationStore.create(form.value));
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
            :form="form"
        />
    </ModalComponent>
</template>

<style scoped>

</style>
