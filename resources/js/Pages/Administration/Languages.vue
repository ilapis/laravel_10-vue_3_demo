<script setup>
import {onMounted, ref} from "vue";
import AdministrationLayout from '@/Layouts/Administration.vue';
import LanguageService from '@/Services/languageService.js';
const languageService = new LanguageService();

const headers = ref([]);
let response = ref(null);

const updateLanguages = async (dataPromise) => {
    response.value = await dataPromise;
    if (response.value.data.length > 0) {
        headers.value = Object.keys(response.value.data[0]);
    }
};

const fetchLanguages = async () => {
    await updateLanguages(languageService.all());
};

const changePage = async (url) => {
    if (url) {
        const urlParams = new URLSearchParams(new URL(url).search);
        const page = urlParams.get('page');
        await updateLanguages(languageService.page(page));
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
        <table class="w-full">
            <thead>
            <tr class="line-height-3rem text-indent-1rem text-align-left">
                <th v-for="header in headers" :key="header">{{ header }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="line-height-3rem text-indent-1rem text-align-left bg-hover-grey" v-for="row in response?.data" :key="row.id">
                <td v-for="header in headers" :key="header">{{ row[header] }}</td>
            </tr>
            </tbody>
        </table>
        <div>
            <div v-for="link in response?.meta?.links" :key="link.label">
                <button class="button-pagination" @click="changePage(link.url)" :disabled="!link.url">
                    {{ decodeHtmlEntities(link.label) }}
                </button>
            </div>
        </div>
    </AdministrationLayout>
</template>

<style scoped>

</style>
