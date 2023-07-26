import {defineStore} from "pinia";
import http from "@/http.js";

export const useLanguageStore = defineStore('language-store', {
    state: () => ({
        collection: null,
        enabled: null,
        errors: null,
        _query_parameter_page: 1,
    }),
    actions: {
        async fetchLanguages() {
            await http.get(`/api/v1/language`).then((response) => {
                this.collection = response.data;
            });
        },

        async fetchEnabled() {
            await http.get(`/api/v1/language/enabled`).then((response) => {
                this.enabled = response.data.data;
            });
        },

        async fetchPage(page) {
            this._query_parameter_page = page;
            await http.get(`/api/v1/language?page=${page}`).then((response) => {
                this.collection = response.data;
            });
        },

        async refreshPage() {
            return this.fetchPage(this._query_parameter_page);
        },

        async create(form) {

            await http.post(`/api/v1/language`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                    this.fetchEnabled();
                }
            });
        },

        async get(id) {

            return http.get(`/api/v1/language/${id}`).then((response) => {
                this.errors = null;
                return response.data.data;
            });
        },

        async update(id, form) {

            return http.put(`/api/v1/language/${id}`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                    this.fetchEnabled();
                }
            });
        },

        async destroy(id) {

            return http.delete(`/api/v1/language/${id}`).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                    this.fetchEnabled();
                }
            });
        },
    },
})
