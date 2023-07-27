<script setup>
import { useTranslationStore } from '@/Stores/translationStore.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import {ref} from "vue";

const translationStore = new useTranslationStore();

const props = defineProps({
    id: Number,
    service: Object,
})

let form = ref({
    language_id: null,
    group: '',
    key: '',
    value: '',
});

const { showModal, openModal, doModalAction } = useModalForm(translationStore, form, (form) => translationStore.update(props.id, form.value));

const populateAndOpenModal = async () => {
    try {
        const { language_id, group, key, value } = await translationStore.get(props.id);
        form.value = { language_id, group, key, value };
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

        <TranslationForm
            :translationStore="translationStore"
            :form="form"
        />
    </ModalComponent>
</template>

<style scoped>

</style>
