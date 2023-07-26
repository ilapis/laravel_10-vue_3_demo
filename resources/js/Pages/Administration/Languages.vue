<script setup>
import {onMounted, onUnmounted, ref} from "vue";
import AdministrationLayout from '@/Layouts/Administration.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useLanguageStore } from '@/Stores/languageStore.js';
import { languageTableSettings } from '@/TableSettings/languageTableSettings.js';

const languageStore = new useLanguageStore();

const fetchLanguages = async () => {
    await languageStore.fetchLanguages();
};

const changePage = async (url) => {
    if (url) {
        const urlParams = new URLSearchParams(new URL(url).search);
        const page = urlParams.get('page');
        await languageStore.fetchPage(page);
    }
};

const decodeHtmlEntities = (str) => {
    let textArea = document.createElement('textarea');
    textArea.innerHTML = str.replace('&laquo;', '').replace('&raquo;', '').trim(' ');

    return textArea.value;
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
        <div>
            <template v-for="link in languageStore.collection?.meta?.links" :key="link.label">
                <ButtonComponent class="btn btn-pagination mt-1" :class="`${(link.active == true) ? 'btn-primary' : 'btn-default'}`" @click="changePage(link.url)" :disabled="!link.url">
                    <template v-if="!isNaN(link.label)">
                    {{ decodeHtmlEntities(link.label.toLowerCase()) }}
                    </template>
                    <template v-else>
                    {{ $t('button.' + decodeHtmlEntities(link.label.toLowerCase())) }}
                    </template>
                </ButtonComponent>
            </template>
        </div>
    </AdministrationLayout>
</template>

<style scoped>

</style>
