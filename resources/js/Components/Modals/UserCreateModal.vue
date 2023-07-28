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
    <ButtonComponent class="btn btn-primary height-12 ml-4 box-shadow" @click="openModal" label="Add" />
    <ModalComponent
        :show="showModal"
        actionLabel="Create"
        @update:show="showModal = $event"
        @update:action="doModalAction($event)" >

        <UserForm
            :userStore="userStore"
            :abilitiesStore="abilitiesStore"
            :form="userStore.getForm()"
        />
    </ModalComponent>
</template>

<style scoped>

</style>
