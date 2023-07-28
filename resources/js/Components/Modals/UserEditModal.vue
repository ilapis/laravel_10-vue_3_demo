<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'UserEditModal'
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

const props = defineProps({
    id: Number,
    service: Object,
})

onMounted( async () => {
    await abilitiesStore.fetchCollection();
});

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
  <ButtonComponent
    class="btn btn-primary height-12 ml-4 box-shadow"
    label="Edit"
    @click="populateAndOpenModal"
  />
  <ModalComponent
    :show="showModal"
    action-label="Update"
    @update:show="showModal = $event"
    @update:action="doModalAction($event)"
  >
    <UserForm
      :user-store="userStore"
      :abilities-store="abilitiesStore"
      :form="userStore.getForm()"
      @update:form="userStore.setForm($event)"
    />
  </ModalComponent>
</template>

<style scoped>

</style>
