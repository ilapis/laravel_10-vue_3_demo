import http from "@/http.js";

export const fetchCollections = {

    async fetchFromEndpoint (endpoint, page = null, perPage = null) {
        let params = {};
        if (page !== null) {
            this._query_parameter_page = page;
        }
        if (page !== null) {
            this._query_parameter_per_page = perPage;
        }
        if (this._sort_by !== null) {
            params[`sortby[${this._sort_by}]`] = this._sort_direction;
        }
        if (page !== null) {
            params['page'] = page;
        } else if (this._query_parameter_page !== null) {
            params['page'] = this._query_parameter_page;
        }
        if (perPage !== null) {
            params['per_page'] = perPage;
        } else if (this._query_parameter_per_page !== null) {
            params['per_page'] = this._query_parameter_per_page;
        }
        console.log(params);

        this._loading = true;
        await http.get(endpoint, { params: params }).then((response) => {
            this.collection = response.data;
            this._loading = false;
        });
    },

    async fetchCollection() {
        await this.fetchFromEndpoint(this._api_endpoint);
    },

    async fetchPage(page, perPage = null) {
        await this.fetchFromEndpoint(this._api_endpoint, page, perPage);
    },

    async refreshPage() {
        return this.fetchPage(this._query_parameter_page);
    },

};
