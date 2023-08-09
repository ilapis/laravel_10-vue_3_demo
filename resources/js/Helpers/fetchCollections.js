import http from "@/http.js";

export const fetchCollections = {

    async fetchFromEndpoint (endpoint, page = null) {
        let params = {};
        if (page !== null) {
            this._query_parameter_page = page;
        }
        if (this._sort_by !== null) {
            params[`sortby[${this._sort_by}]`] = this._sort_direction;
        }
        if (page !== null) {
            params['page'] = page;
        } else if (this._query_parameter_page !== null) {
            params['page'] = this._query_parameter_page;
        }

        await http.get(endpoint, { params: params }).then((response) => {
            this.collection = response.data;
        });
    },

    async fetchCollection() {
        await this.fetchFromEndpoint(this._api_endpoint);
    },

    async fetchPage(page) {
        await this.fetchFromEndpoint(this._api_endpoint, page);
    },

    async refreshPage() {
        return this.fetchPage(this._query_parameter_page);
    },

};
