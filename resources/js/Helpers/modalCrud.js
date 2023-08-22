import http from "@/http.js";

export const modalCrud = {

    async create(form) {
        return http.post(`${this._api_endpoint}`, form).then((response) => {
            if (response?.data?.errors) {
                this.errors = response?.data?.errors;
            } else {
                this.errors = null;
                this.refreshPage();
            }
        });
    },

    async get(id) {
        return http.get(`${this._api_endpoint}/${id}`).then((response) => {
            this.errors = {};
            if (response.status === 200) {
                return response.data.data;
            }
            return null;
        });
    },

    async update(id, form) {
        return http.put(`${this._api_endpoint}/${id}`, form).then((response) => {
            if (response?.data?.errors) {
                this.errors = response?.data?.errors;
            } else {
                this.errors = null;
                this.refreshPage();
            }
        });
    },

    async destroy(id) {
        return http.delete(`${this._api_endpoint}/${id}`).then((response) => {
            if (response?.data?.errors) {
                this.errors = response?.data?.errors;
            } else {
                this.errors = null;
                this.refreshPage();
            }
        });
    },
};
