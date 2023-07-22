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
        update().then(() => {
            if (!languageStore?.errors) {
                hideModal();
            }
        });
    }
}

let form = reactive({
    code: '',
    name: '',
    enabled: false,
});

const props = defineProps({
    id: Number,
})

const hideModal = async () => {
    showModal.value = false;
}

const openModal = async () => {
    const { code, name, enabled } = await languageStore.get(props.id);
    form = { code, name, enabled };
    showModal.value = true;
}

const update = () => {
    return languageStore.update(props.id, form);
}
</script>

<template>
    <ButtonComponent class="btn btn-primary height-12 ml-4 box-shadow-6" @click="openModal" label="Edit" />
    <ModalComponent
        :show="showModal"
        actionLabel="Update"
        @update:show="showModal = $event"
        @update:action="doModalAction($event)" >

        <InputText
            label="Code"
            :underlineText="(languageStore?.errors?.code) ? languageStore.errors.code : ['The Code field is required.']"
            v-model="form.code"
        />

        <InputText
            label="Language"
            :underlineText="(languageStore?.errors?.name && languageStore.errors?.name) ? languageStore.collection.errors.name : ['The Language field is required.']"
            v-model="form.name"
        />

        <InputCheckbox
            label="Enabled"
            :underlineText="(languageStore?.errors?.enabled && languageStore.errors?.enabled) ? languageStore.collection.errors.enabled : ['']"
            v-model="form.enabled"
        />
        <br/>
    </ModalComponent>
</template>

<style scoped>

</style>
