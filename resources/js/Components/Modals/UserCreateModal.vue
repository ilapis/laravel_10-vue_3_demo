<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'UserCreateModal'
});
</script>

<script setup>
import userFormDefault from '@/FormsDefaults/userForm.js';
import {useUserStore} from '@/Stores/userStore.js';
import UserForm from '@/Forms/UserForm.vue';
import CreateModal from "@/Components/Modals/CreateModal.vue";

const userStore = new useUserStore();
</script>

<template>
    <CreateModal
        :form-component="UserForm"
        :form-defaults="userFormDefault"
        :store="userStore"
    />
</template>

<style scoped>

</style>
