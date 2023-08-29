import {defineStore} from "pinia";
import http from "@/http.js";
import {formMethods} from '@/Helpers/formMethods.js';
import {fetchCollections} from '@/Helpers/fetchCollections.js';
import {apiState} from '@/Helpers/apiState.js';
import {modalCrud} from '@/Helpers/modalCrud.js';

export const useLanguageStore = defineStore('language-store', {
    state: () => ({
        ...apiState,
        _api_endpoint: '/api/v1/language',
    }),
    actions: {

        ...formMethods,
        ...fetchCollections,
        ...modalCrud,

        async fetchEnabled() {
            await http.get(`${this._api_endpoint}/enabled`).then((response) => {
                this.enabled = response.data.data;
            });
        },

        async fetchFullCollection() {
            await http.get(`/api/v1/language/all`).then((response) => {
                this.fullCollection = response.data.data;
            });
        },

        afterCreate() {
            this.fetchEnabled();
        },

        afterUpdate() {
            this.fetchEnabled();
        },

        afterDelete() {
            this.fetchEnabled();
        },

    },
})
