import {defineStore} from "pinia";
import http from "@/http.js";
import {formMethods} from '@/Helpers/formMethods.js';
import {fetchCollections} from '@/Helpers/fetchCollections.js';

export const useLanguageStore = defineStore('language-store', {
    state: () => ({
        fullCollection: null,
        collection: null,
        enabled: null,
        errors: null,
        _api_endpoint: '/api/v1/language',
        _query_parameter_page: 1,
        _query_parameter_per_page: 10,
        _sort_by: 'id',
        _sort_direction: -1,
        _loading: false,
    }),
    actions: {

        ...formMethods,
        ...fetchCollections,

        async fetchEnabled() {
            await http.get(`/api/v1/language/enabled`).then((response) => {
                this.enabled = response.data.data;
            });
        },

        async fetchFullCollection() {
            await http.get(`/api/v1/language/all`).then((response) => {
                this.fullCollection = response.data.data;
            });
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
