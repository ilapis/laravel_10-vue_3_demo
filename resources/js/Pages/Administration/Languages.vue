<script setup>
import {onMounted} from "vue";
import AdministrationLayout from '@/Layouts/Administration.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useLanguageStore } from '@/Stores/languageStore.js';
import { languageTableSettings } from '@/TableSettings/languageTableSettings.js';

const languageStore = new useLanguageStore();

const fetchLanguages = async () => {
    await languageStore.fetchLanguages();
};

onMounted( () => {
    fetchLanguages();
});
</script>

<template>
    <AdministrationLayout>
        <div class="w-full mt-4 height-12">
            <LanguageCreateModal />
        </div>
        <div class="w-full" style="height:calc(100% - 8rem);">
            <TableComponent
                :service="languageStore"
                :rows="languageStore.collection?.data"
                :rowSettings="languageTableSettings"
            />
        </div>
        <TablePaginationComponent :links="languageStore.collection?.meta?.links" :service="languageStore" />
    </AdministrationLayout>
</template>

<style scoped>

</style>
