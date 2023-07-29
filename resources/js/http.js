import axios from 'axios';
import { getLanguage, loadLanguage } from '@/utils.js';

const http = axios.create({
    //baseURL: 'https://localhost',
    headers: {
        'Content-Type': 'application/json',
    },
    validateStatus: function (status) {
        if (status === 401) {
            //@TODO session check, redirect?
        }
        return status >= 200 && status < 500; // Resolve only if the status code is less than 500
    }
    // other custom settings
});

// Add a request interceptor
http.interceptors.request.use(function (config) {
    // Do something before request is sent
    // For example, add your logic to add token to headers

    // Append JWT token to headers if it exists in localStorage
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    const language = getLanguage();
    if (language) {
        config.headers['Accept-Language'] = `${language}`;
    }

    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

// Add a response interceptor
http.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    return Promise.reject(error);
});

export default http;
