<script setup>
import {onMounted} from "vue";
import AdministrationLayout from '@/Layouts/Administration.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useTranslationStore } from '@/Stores/translationStore.js';
import { translationTableSettings } from '@/TableSettings/translationTableSettings.js';
import TranslationCreateModal from "@/Components/Modals/TranslationCreateModal.vue";

const translationStore = new useTranslationStore();

//const fetchTranslations = async () => {
//    await translationStore.fetchCollection();
//};

onMounted( async () => {
    //fetchTranslations();
    await translationStore.fetchCollection();
});
</script>

<template>
    <AdministrationLayout>
        <div class="w-full mt-4 height-12">
            <TranslationCreateModal />
        </div>
        <div class="w-full" style="height:calc(100% - 8rem);">
            <TableComponent
                :service="translationStore"
                :rows="translationStore.collection?.data"
                :rowSettings="translationTableSettings"
            />
        </div>
        <TablePaginationComponent :links="translationStore.collection?.meta?.links" :service="translationStore" />
    </AdministrationLayout>
</template>

<style scoped>

</style>
