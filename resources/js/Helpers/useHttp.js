// useHttp.js
import { ref } from 'vue';

export default function useHttp() {
    const isLoading = ref(false);

    const get = async (url, headers = {}) => {
        return await sendRequest(url, 'GET', null, headers);
    };

    const post = async (url, body = null, headers = {}) => {
        return await sendRequest(url, 'POST', body, headers);
    };

    const put = async (url, body = null, headers = {}) => {
        return await sendRequest(url, 'PUT', body, headers);
    };

    const del = async (url, headers = {}) => {
        return await sendRequest(url, 'DELETE', null, headers);
    };

    const sendRequest = async (url, method, body, headers) => {
        isLoading.value = true;
        let data = null;

        // Append JWT token to headers if it exists in localStorage
        const token = localStorage.getItem('token');
        if (token) {
            headers['Authorization'] = `Bearer ${token}`;
        }

        const response = await fetch(url, {
            method,
            body: body ? JSON.stringify(body) : null,
            headers: {
                'Content-Type': 'application/json',
                ...headers
            }
        });

        data = await response.json(); // Process the response data, even if there's an error.

        if (!response.ok) {
            data = {error: !response.ok, ...data}; // Include the error message and the response data.
        }
        isLoading.value = false;

        return data;
    };

    return { isLoading, get, post, put, del };
}
