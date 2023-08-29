import {defineStore} from "pinia";
import {formMethods} from '@/Helpers/formMethods.js';
import {fetchCollections} from '@/Helpers/fetchCollections.js';
import {modalCrud} from "@/Helpers/modalCrud.js";
import {apiState} from "@/Helpers/apiState.js";

export const useTranslationStore = defineStore('translation-store', {
    state: () => ({
        ...apiState,
        _api_endpoint: '/api/v1/translation',
        _sort_by: 'translations.id',
    }),
    actions: {

        ...formMethods,
        ...fetchCollections,
        ...modalCrud,
    },
})
