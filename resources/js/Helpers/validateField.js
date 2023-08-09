import http from "@/http.js";

export const validateField = {

    async validateField(field, value, id = null) {
        let data = {};
        data[field] = value;

        if (this.errors === null) {
            this.errors = {};
        }

        // Determine the HTTP method and URL based on whether id is provided
        const method = id ? 'put' : 'post';
        const url = this._api_endpoint + (id ? `/${id}` : '');

        try {
            const response = await http[method](url, data, { headers: { 'X-Dry-Run': true } });

            if (response.status === 422) {
                this.errors[field] = response?.data?.errors[field];
            } else {
                this.errors[field] = null;
            }
        } catch (error) {
            console.error('Error validating field:', error);
            // You might want to update the errors object with a general error message
            this.errors[field] = ['An error occurred while validating the field.'];
        }
    },
};
