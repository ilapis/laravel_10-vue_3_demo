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

const translationStore = new useTranslationStore();

const props = defineProps({
    id: Number,
    service: Object,
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
    <TranslationForm
      :translation-store="translationStore"
      :form="translationStore.getForm()"
      @update:form="translationStore.setForm($event)"
    />
  </ModalComponent>
</template>

<style scoped>

</style>
