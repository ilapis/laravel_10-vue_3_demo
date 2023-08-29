<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'DeleteModal'
});
</script>

<script setup>

import {ref} from "vue";
import { useLanguageStore } from '@/Stores/languageStore.js';
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import {editModalProps} from "@/Helpers/editModalProps.js";

const languageStore = new useLanguageStore();
const showModal = ref(false);

const doModalAction = (action) => {
    if ('cancel' === action) {
         hideModal();
    }
    if ('action' === action) {
        destroy().then(() => {
            if (!languageStore?.errors) {
                hideModal();
            }
        });
    }
}

const doModalActionRestore = (action) => {
    if ('cancel' === action) {
        hideModal();
    }
    if ('action' === action) {
        restore().then(() => {
            if (!languageStore?.errors) {
                hideModal();
            }
        });
    }
}

const props = defineProps({...editModalProps})

const hideModal = async () => {
    showModal.value = false;
}

const openModal = async () => {
    showModal.value = true;
}

const destroy = () => {
    return props.service.destroy(props.id);
}
const restore = () => {
    return props.service.restore(props.id);
}
</script>

<template>
  <template v-if="data.deleted_at === null || data.deleted_at === undefined">
    <Button
      severity="danger"
      class="ml-4 box-shadow"
      :label="$t('button.delete')"
      @click="openModal"
    />
    <Dialog
      v-model:visible="showModal"
      modal
      :header="$t('button.delete')"
      :style="{ width: '50vw' }"
      @hide="doModalAction('cancel')"
    >
      {{ $t('warning.delete_record') }}
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
          severity="danger"
          :label="$t('button.delete')"
          icon="pi pi-check"
          autofocus
          @click="doModalAction('action')"
        />
      </template>
    </Dialog>
  </template>
  <template v-else>
    <Button
      severity="success"
      class="ml-4 box-shadow"
      :label="$t('button.restore')"
      @click="openModal"
    />
    <Dialog
      v-model:visible="showModal"
      modal
      :header="$t('button.restore')"
      :style="{ width: '50vw' }"
      @hide="doModalActionRestore('cancel')"
    >
      {{ $t('warning.restore_record') }}
      <template #footer>
        <Button
          severity="secondary"
          class="p-button-secondary float-left"
          :label="$t('button.cancel')"
          icon="pi pi-times"
          text
          @click="doModalActionRestore('cancel')"
        />
        <Button
          severity="success"
          :label="$t('button.restore')"
          icon="pi pi-check"
          autofocus
          @click="doModalActionRestore('action')"
        />
      </template>
    </Dialog>
  </template>
</template>

<style scoped>

</style>
