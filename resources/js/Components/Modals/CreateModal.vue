<script setup>
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import { useModalForm } from '@/Helpers/useModalForm.js';

const props = defineProps({
    formComponent: {type: Object, default: null},
    formDefaults: {type: Object, default: null},
    store: {type: Object, default: null},
});

props.store.setForm(props.formDefaults);
const { showModal, openModal, doModalAction } = useModalForm(props.store, () => props.store.create(props.store.getForm()));
</script>

<template>
  <Button
    class="ml-4"
    :label="$t('button.add')"
    @click="openModal()"
  />

  <Dialog
    v-model:visible="showModal"
    modal
    :header="$t('button.create')"
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
        :label="$t('button.create')"
        icon="pi pi-check"
        autofocus
        @click="doModalAction('action')"
      />
    </template>
  </Dialog>
</template>
