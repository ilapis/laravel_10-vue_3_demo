import {defineStore} from "pinia";
import http from "@/http.js";
import {formMethods} from '@/Helpers/formMethods.js';

export const useTranslationStore = defineStore('translation-store', {
    state: () => ({
        collection: null,
        enabled: null,
        errors: null,
        _query_parameter_page: 1,
    }),
    actions: {

        ...formMethods,

        async fetchTranslations() {
            await http.get(`/api/v1/translation`).then((response) => {
                this.collection = response.data;
            });
        },

        async fetchPage(page) {
            this._query_parameter_page = page;
            await http.get(`/api/v1/translation?page=${page}`).then((response) => {
                this.collection = response.data;
            });
        },

        async refreshPage() {
            return this.fetchPage(this._query_parameter_page);
        },

        async create(form) {

            await http.post(`/api/v1/translation`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                }
            });
        },

        async get(id) {

            return http.get(`/api/v1/translation/${id}`).then((response) => {
                this.errors = null;
                return response.data.data;
            });
        },

        async update(id, form) {

            return http.put(`/api/v1/translation/${id}`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                }
            });
        },

        async destroy(id) {

            return http.delete(`/api/v1/translation/${id}`).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                }
            });
        },
    },
})