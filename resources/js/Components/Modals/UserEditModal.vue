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
    <UserForm />
  </ModalComponent>
</template>

<style scoped>

</style>
