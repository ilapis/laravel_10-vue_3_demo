import {defineStore} from "pinia";
import {formMethods} from '@/Helpers/formMethods.js';
import {fetchCollections} from '@/Helpers/fetchCollections.js';
import {validateField} from '@/Helpers/validateField.js';
import {apiState} from '@/Helpers/apiState.js';
import {modalCrud} from '@/Helpers/modalCrud.js';

export const useArticleStore = defineStore('article-store', {
    state: () => ({
        ...apiState,
        _api_endpoint: '/api/v1/article',
    }),
    actions: {

        ...formMethods,
        ...fetchCollections,
        ...modalCrud,
        ...validateField,
    },
})
