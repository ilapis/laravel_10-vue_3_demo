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

const languageStore = new useLanguageStore();

languageStore.setForm(languageForm);

const { showModal, openModal, doModalAction } = useModalForm(languageStore, () => languageStore.create(languageStore.getForm()));
</script>

<template>
  <ButtonComponent
    class="btn btn-primary height-12 ml-4 box-shadow"
    label="Add"
    @click="openModal"
  />
  <ModalComponent
    :show="showModal"
    action-label="Create"
    @update:show="showModal = $event"
    @update:action="doModalAction($event)"
  >
    <LanguageForm
      :language-store="languageStore"
      :form="languageStore.getForm()"
    />
  </ModalComponent>
</template>

<style scoped>

</style>
