<script setup>
import {onMounted, ref} from "vue";
import AdministrationLayout from '@/Layouts/Administration.vue';
import { useLanguageStore } from '@/Stores/languageStore.js';
const languageStore = new useLanguageStore();

const headers = ref([]);

const updateLanguages = async (dataPromise) => {
    await dataPromise;
    if (languageStore.collection.data.length > 0) {
        headers.value = Object.keys(languageStore.collection.data[0]);
        setTableBodyHeight();
    }
};

const fetchLanguages = async () => {
    await updateLanguages(languageStore.fetchLanguages());
};

const setTableBodyHeight = () => {
    document.getElementById("languages_table_body").style.height = window.innerHeight - 228 + "px";
};

const changePage = async (url) => {
    if (url) {
        const urlParams = new URLSearchParams(new URL(url).search);
        const page = urlParams.get('page');
        await updateLanguages(languageStore.fetchPage(page));
    }
};

const decodeHtmlEntities = (str) => {
    let textArea = document.createElement('textarea');
    textArea.innerHTML = str;
    return textArea.value;
};

onMounted(fetchLanguages);

</script>

<template>
    <AdministrationLayout>
        <div class="w-full mt-4 height-12">
            <LanguageCreateModal />
        </div>
        <div class="w-full" style="height:calc(100% - 8rem);">
        <table class="w-full" style="height:calc(100% - 8rem);">
            <thead>
            <tr class="line-height-3rem text-indent-1rem text-align-left">
                <th class=" height-12" v-for="header in headers" :key="header">{{ header }}</th>
            </tr>
            </thead>
            <tbody id='languages_table_body' class="w-full">
            <tr class="line-height-3rem text-indent-1rem text-align-left bg-hover-grey" v-for="row in languageStore.collection?.data" :key="row.id">
                <td class=" height-12" v-for="header in headers" :key="header">{{ row[header] }}</td>
            </tr>
            </tbody>
        </table>
        </div>
        <div class="mt-4 height-12">
            <template v-for="link in languageStore.collection?.meta?.links" :key="link.label">
                <button class="btn btn-pagination mt-1" :class="{'btn-primary': link.active, 'btn-default': !link.active}" @click="changePage(link.url)" :disabled="!link.url">
                    {{ decodeHtmlEntities(link.label) }}
                </button>
            </template>
        </div>
    </AdministrationLayout>
</template>

<style scoped>

</style>
