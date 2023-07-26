<script setup>
import {onMounted, onUnmounted, ref} from "vue";
import AdministrationLayout from '@/Layouts/Administration.vue';
import TableComponent from "@/Components/UI/TableComponent.vue";
import { useLanguageStore } from '@/Stores/languageStore.js';

const languageStore = new useLanguageStore();

const updateLanguages = async (dataPromise) => {
    await dataPromise;
    //if (languageStore.collection.data.length > 0) {
    //    setTableBodyHeight();
    //}
};

const fetchLanguages = async () => {
    await updateLanguages(languageStore.fetchLanguages());
};

//const setTableBodyHeight = () => {
//    document.getElementById("languages_table_body").style.height = window.innerHeight - 276 + "px";
//};

const changePage = async (url) => {
    if (url) {
        const urlParams = new URLSearchParams(new URL(url).search);
        const page = urlParams.get('page');
        await updateLanguages(languageStore.fetchPage(page));
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

const rowSettings = ref([
    {
        'column': 'id',
        'width': '80px',
    },
    {
        'column': 'code',
        'title': 'language_code',
    },
    {
        'column': 'name',
        'title': 'language',
    },
    {
        'column': 'enabled',
        'width': '100px',
    },
    {
        'column': 'created_at',
    },
    {
        'column': 'updated_at',
    },
    {
        'type': 'component',
        'width': '100px',
        'component': 'LanguageEditModal'
    },
    {
        'type': 'component',
        'width': '135px',
        'component': 'DeleteModal'
    },
]);
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
                :rowSettings="rowSettings"
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
