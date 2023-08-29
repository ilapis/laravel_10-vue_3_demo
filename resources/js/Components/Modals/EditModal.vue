<script setup>
import { defineProps } from 'vue';
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import { useModalForm } from '@/Helpers/useModalForm.js';

const props = defineProps({
    formComponent: {type: Object, default: null},
    formDefaults: {type: Object, default: null},
    store: {type: Object, default: null},
    id: {type: Number, default: null},
    data: {type: Object, default: null},
    disabledCondition: {
        type: Function,
        default: () => { return false}
    },
    service: {type: Object, default: null},
});

props.store.setForm(props.formDefaults);
const { showModal, openModal, doModalAction } = useModalForm(props.store, () => props.store.update(props.id, props.store.getForm()));

const populateAndOpenModal = async () => {
    try {
        props.store.updateForm(await props.store.get(props.id));
        openModal();
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
  <Button
    class="ml-4"
    :label="$t('button.edit')"
    :disabled="disabledCondition(data)"
    @click="populateAndOpenModal"
  />

  <Dialog
    v-model:visible="showModal"
    modal
    :header="$t('button.edit')"
    :style="{ width: '50vw' }"
    @hide="doModalAction('cancel')"
  >
    <component :is="props.formComponent" />
    <template #footer>
      <Button
        severity="secondary"
        class="float-left"
        :label="$t('button.cancel')"
        icon="pi pi-times"
        text
        @click="doModalAction('cancel')"
      />
      <Button
        :label="$t('button.edit')"
        icon="pi pi-check"
        autofocus
        @click="doModalAction('action')"
      />
    </template>
  </Dialog>
</template>

<style scoped>
/* Your styles here */
</style>
