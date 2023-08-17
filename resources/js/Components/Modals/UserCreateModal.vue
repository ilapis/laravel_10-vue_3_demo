<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'UserCreateModal'
});
</script>

<script setup>
import { useUserStore } from '@/Stores/userStore.js';
import { useAbilitiesStore } from '@/Stores/abilitiesStore.js';
import userForm from '@/FormsDefaults/userForm.js';
import { useModalForm } from '@/Helpers/useModalForm.js';
import {onMounted} from "vue";
import Button from "primevue/button";
import Dialog from "primevue/dialog";

const userStore = new useUserStore();
const abilitiesStore = new useAbilitiesStore();

userStore.setForm(userForm);

onMounted( async () => {
    await abilitiesStore.fetchCollection();
});

const { showModal, openModal, doModalAction } = useModalForm(userStore, () => userStore.create(userStore.getForm()));
</script>

<template>
    <Button class="ml-4 box-shadow" :label="$t('button.add')" @click="openModal(true)" />
    <!--
  <ModalComponent
    :show="showModal"
    action-label="Create"
    @update:show="showModal = $event"
    @update:action="doModalAction($event)"
  >
    <UserForm />
  </ModalComponent>
-->
    <Dialog v-model:visible="showModal" modal :header="$t('button.create')" :style="{ width: '50vw' }" @hide="doModalAction('cancel')">
        <UserForm />
        <template #footer>
            <Button severity="secondary" class="float-left" :label="$t('button.cancel')" icon="pi pi-times" @click="doModalAction('cancel')" text />
            <Button :label="$t('button.create')" icon="pi pi-check" @click="doModalAction('action')" autofocus />
        </template>
    </Dialog>
</template>

<style scoped>

</style>
