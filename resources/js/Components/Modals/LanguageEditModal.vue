<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import languageForm from '@/FormsDefaults/languageForm.js';

const languageStore = new useLanguageStore();

const props = defineProps({
    id: Number,
    service: Object,
})

languageStore.setForm(languageForm);

const { showModal, openModal, doModalAction } = useModalForm(languageStore, () => languageStore.update(props.id, languageStore.getForm()));

const populateAndOpenModal = async () => {
    try {
        const { code, name, enabled } = await languageStore.get(props.id);
        languageStore.updateForm({ code, name, enabled })
        openModal();
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <ButtonComponent class="btn btn-primary height-12 ml-4 box-shadow" @click="populateAndOpenModal" label="Edit" />
    <ModalComponent
        :show="showModal"
        actionLabel="Update"
        @update:show="showModal = $event"
        @update:action="doModalAction($event)" >

        <LanguageForm
            :languageStore="languageStore"
            :form="languageStore.getForm()"
        />
    </ModalComponent>
</template>

<style scoped>

</style>
