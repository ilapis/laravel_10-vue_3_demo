<script setup>
import {onMounted} from "vue";
import AdministrationLayout from '@/Layouts/Administration.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useUserStore } from '@/Stores/userStore.js';
import {userTableSettings} from "@/TableSettings/userTableSettings.js";

const userStore = new useUserStore();

onMounted( async () => {
    await userStore.fetchUsers();
});
</script>

<template>
    <AdministrationLayout>
        <div class="w-full mt-4 height-12">
            <UserCreateModal />
        </div>
        <div class="w-full" style="height:calc(100% - 8rem);">
            <TableComponent
                :service="userStore"
                :rows="userStore.collection?.data"
                :rowSettings="userTableSettings"
            />
        </div>
        <TablePaginationComponent :links="userStore.collection?.meta?.links" :service="userStore" />
    </AdministrationLayout>
</template>

<style scoped>

</style>
