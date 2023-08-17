import {defineStore} from "pinia";
import http from "@/http.js";
import {formMethods} from '@/Helpers/formMethods.js';
import {fetchCollections} from '@/Helpers/fetchCollections.js';

export const useUserStore = defineStore('user-store', {
    state: () => ({
        collection: null,
        enabled: null,
        errors: null,
        _api_endpoint: '/api/v1/user',
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
            await http.get(`/api/v1/user/enabled`).then((response) => {
                this.enabled = response.data.data;
            });
        },

        async create(form) {

            return http.post(`/api/v1/user`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                }
            });
        },

        async get(id) {

            return http.get(`/api/v1/user/${id}`).then((response) => {
                this.errors = null;
                return response.data.data;
            });
        },

        async update(id, form) {

            return http.put(`/api/v1/user/${id}`, form).then((response) => {

                if (response?.data?.errors) {
                    this.errors = response?.data?.errors;
                } else {
                    this.errors = null;
                    this.refreshPage();
                }
            });
        },

        async destroy(id) {

            return http.delete(`/api/v1/user/${id}`).then((response) => {

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
