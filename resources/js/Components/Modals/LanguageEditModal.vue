<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import {ref} from "vue";

const languageStore = new useLanguageStore();

const props = defineProps({
    id: Number,
})

let form = ref({
    code: '',
    name: '',
    enabled: false,
});

const { showModal, openModal, doModalAction } = useModalForm(languageStore, form, (form) => languageStore.update(props.id, form.value));

const populateAndOpenModal = async () => {
    try {
        const { code, name, enabled } = await languageStore.get(props.id);
        form.value = { code, name, enabled };
        openModal();
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <ButtonComponent class="btn btn-primary height-12 ml-4 box-shadow-6" @click="populateAndOpenModal" label="Edit" />
    <ModalComponent
        :show="showModal"
        actionLabel="Update"
        @update:show="showModal = $event"
        @update:action="doModalAction($event)" >

        <LanguageForm
            :languageStore="languageStore"
            :form="form"
        />
        <br/>
    </ModalComponent>
</template>

<style scoped>

</style>
