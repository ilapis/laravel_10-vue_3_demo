<script setup>

import {reactive, ref} from "vue";
import { useLanguageStore } from '@/Stores/languageStore.js';
const languageStore = new useLanguageStore();

const showModal = ref(false);
let response = ref(null);
const doModalAction = async (action) => {
    if ('cancel' === action) {
        showModal.value = false;
    }
    if ('action' === action) {
        await languageStore.createLanguage(form);
    }
}

const form = reactive({
    code: '',
    name: '',
    enabled: false,
});
</script>

<template>
    <Button class="btn btn-primary height-12 ml-4 box-shadow-6" @click="showModal = true" label="Add" />
    <ModalComponent
        :show="showModal"
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

        /*@TODO*/
        <input type="checkbox" value="true" v-model="form.enabled">
        <label for="jack">Jack</label>

        <br/>
    </ModalComponent>
</template>

<style scoped>

</style>
