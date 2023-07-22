<script setup>

import {reactive, ref} from "vue";
import { useLanguageStore } from '@/Stores/languageStore.js';

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
/*
let form = reactive({
    code: '',
    name: '',
    enabled: false,
});
*/
const props = defineProps({
    id: Number,
    service: Object,
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
    <ButtonComponent class="btn btn-danger height-12 ml-4 box-shadow-6" @click="openModal" label="Delete" />
    <ModalComponent
        :show="showModal"
        actionLabel="Delete"
        @update:show="showModal = $event"
        @update:action="doModalAction($event)" >

    </ModalComponent>
</template>

<style scoped>

</style>
