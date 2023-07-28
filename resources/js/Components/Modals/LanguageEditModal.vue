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
  <ButtonComponent
    class="btn btn-primary height-12 ml-4 box-shadow"
    label="Edit"
    @click="populateAndOpenModal"
  />
  <ModalComponent
    :show="showModal"
    action-label="Update"
    @update:show="showModal = $event"
    @update:action="doModalAction($event)"
  >
    <LanguageForm
      :language-store="languageStore"
      :form="languageStore.getForm()"
      @update:form="languageStore.setForm($event)"
    />
  </ModalComponent>
</template>

<style scoped>

</style>
