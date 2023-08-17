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

const hideModal = async () => {
    showModal.value = false;
}

const openModal = async () => {
    showModal.value = true;
}

const destroy = () => {
    return props.service.destroy(props.id);
}
</script>

<template>
    <Button severity="danger" class="ml-4 box-shadow" :label="$t('button.delete')" @click="openModal" />
  <ModalComponent
    :show="showModal"
    action-label="Delete"
    @update:show="showModal = $event"
    @update:action="doModalAction($event)"
  />
</template>

<style scoped>

</style>
