import {defineStore} from "pinia";
import http from "@/http.js";

export const useLanguageStore = defineStore('language-store', {
    state: () => ({
        collection: null,
        errors: null,
        _query_parameter_page: 1,
    }),
    actions: {
        async fetchLanguages() {
            await http.get(`/api/v1/language`).then((response) => {
                this.collection = response.data;
            });
        },

        async fetchPage(page) {
            this._query_parameter_page = page;
            await http.get(`/api/v1/language?page=${page}`).then((response) => {
                this.collection = response.data;
            });
        },

        async refreshPage() {
            await this.fetchPage(this._query_parameter_page);
        },

        async post(form) {
            this.errors = null;

            await http.post(`/api/v1/language`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.refreshPage();
                }
            });
        },

        async get(id) {
            this.errors = null;

            return http.get(`/api/v1/language/${id}`).then((response) => {
                return response.data.data;
            });
        },

        async update(id, form) {
            this.errors = null;

            http.put(`/api/v1/language/${id}`, form).then((response) => {
                this.refreshPage();
            });
        },
    },
})
