<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'UserEditModal'
});
</script>

<script setup>
import userForm from '@/FormsDefaults/userForm.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import { useUserStore } from '@/Stores/userStore.js';
import Button from "primevue/button";
import Dialog from "primevue/dialog";
const userStore = new useUserStore();

userStore.setForm(userForm);

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

const { showModal, openModal, doModalAction } = useModalForm(userStore, () => userStore.update(props.id, userStore.getForm()));

const populateAndOpenModal = async () => {
    try {
        userStore.updateForm(await userStore.get(props.id));
        openModal();
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <Button class="ml-4 box-shadow" :label="$t('button.edit')" @click="populateAndOpenModal" />
  <!--<ModalComponent
    :show="showModal"
    action-label="Update"
    @update:show="showModal = $event"
    @update:action="doModalAction($event)"
  >
    <UserForm />
  </ModalComponent>
    -->

    <Dialog v-model:visible="showModal" modal :header="$t('button.create')" :style="{ width: '50vw' }">
        <UserForm />
        <template #footer>
            <Button severity="secondary" class="float-left" :label="$t('button.cancel')" icon="pi pi-times" @click="doModalAction('cancel')" text />
            <Button :label="$t('button.create')" icon="pi pi-check" @click="doModalAction('action')" autofocus />
        </template>
    </Dialog>
</template>

<style scoped>

</style>
