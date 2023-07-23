<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import {ref} from "vue";

const languageStore = new useLanguageStore();

let form = ref({
    code: '',
    name: '',
    enabled: false
});

const { showModal, openModal, doModalAction } = useModalForm(languageStore, form, (form) => languageStore.create(form.value));
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
            :form="form"
        />
    </ModalComponent>
</template>

<style scoped>

</style>
