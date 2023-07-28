import axios from 'axios';

export function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
function setCookie(name, value, days = 365, path = '/') {
    const expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=' + path;
}

export function getLanguage() {
    let language;

    try {
        language = localStorage.getItem('language');
        if (language) return language;
    } catch (e) {}

    try {
        language = getCookie('language');
        if (language) return language;
    } catch (e) {}

    return import.meta.env.VITE_APP_DEFAULT_LANGUAGE;
}

export function setLanguage(language) {
    try {
        localStorage.setItem('language', language);
    } catch (e) {
        console.error('Failed to set language in localStorage', e);
    }

    try {
        setCookie('language', language);
    } catch (e) {
        console.error('Failed to set language in cookie', e);
    }
}

export function loadLanguage(language) {
    axios.get(`/api/v1/translation/locale/${language}`).then((messages) => {
        window.i18n.global.setLocaleMessage(language, messages.data);
        window.i18n.global.locale = language;

        setLanguage(language);
    });
}