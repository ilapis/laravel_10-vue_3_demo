import {defineStore} from "pinia";
import http from "@/http.js";
import {formMethods} from '@/Helpers/formMethods.js';
import {fetchCollections} from '@/Helpers/fetchCollections.js';
import {validateField} from '@/Helpers/validateField.js';

export const useArticleStore = defineStore('article-store', {
    state: () => ({
        collection: null,
        errors: null,
        _api_endpoint: '/api/v1/article',
        _query_parameter_page: 1,
        _query_parameter_per_page: 10,
        _sort_by: 'id',
        _sort_direction: -1,
        _loading: false,
    }),
    actions: {

        ...formMethods,
        ...fetchCollections,
        ...validateField,

        hasErrors() {
            return this.errors && Object.keys(this.errors).length > 0;
        },

        async create(form) {

            return http.post(`/api/v1/article`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = {};
                    this.refreshPage();
                }
            });
        },

        async get(id) {

            return http.get(`/api/v1/article/${id}`).then((response) => {
                this.errors = {};
                if (response.status == 200) {
                    return response.data.data;
                }
                return null;
            });
        },

        async update(id, form) {

            return http.put(`/api/v1/article/${id}`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = {};
                    this.refreshPage();
                }
            });
        },

        async destroy(id) {

            return http.delete(`/api/v1/article/${id}`).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = {};
                    this.refreshPage();
                }
            });
        },
    },
})
