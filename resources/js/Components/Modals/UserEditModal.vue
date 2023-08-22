<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'UserEditModal'
});
</script>

<script setup>
import {defineProps} from "vue";
import userFormDefault from '@/FormsDefaults/userForm.js';
import UserForm from '@/Forms/UserForm.vue';
import {useUserStore} from '@/Stores/userStore.js';
import {editModalProps} from "@/Helpers/editModalProps.js";
import EditModal from "@/Components/Modals/EditModal.vue";

const props = defineProps({...editModalProps});
const userStore = new useUserStore();
</script>

<template>
    <EditModal
        :id="props.id"
        :form-component="UserForm"
        :form-defaults="userFormDefault"
        :store="userStore"
        :data="props.data"
        :disabled-condition="data => data['deleted_at'] !== null"
    />
</template>

<style scoped>

</style>
