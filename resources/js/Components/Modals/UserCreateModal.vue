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

const userStore = new useUserStore();
const abilitiesStore = new useAbilitiesStore();

userStore.setForm(userForm);

onMounted( async () => {
    await abilitiesStore.fetchCollection();
});

const { showModal, openModal, doModalAction } = useModalForm(userStore, () => userStore.create(userStore.getForm()));
</script>

<template>
  <ButtonComponent
    class="btn btn-primary height-12 ml-4 box-shadow"
    label="Add"
    @click="openModal(true)"
  />
  <ModalComponent
    :show="showModal"
    action-label="Create"
    @update:show="showModal = $event"
    @update:action="doModalAction($event)"
  >
    <UserForm />
  </ModalComponent>
</template>

<style scoped>

</style>
