import './bootstrap';
import {createApp} from 'vue';
import App from './App.vue';
import router from './router.js';
import {setCookie} from './utils.js';
import {createPinia} from 'pinia';
import {createI18n} from 'vue-i18n';
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css';

import {getLanguage, loadLanguage} from './utils';
import UnderlineComponent from "@/Components/UI/UnderlineComponent.vue";
import InputText from "@/Components/UI/InputText.vue";
import InputPassword from "@/Components/UI/InputPassword.vue";
import InputCheckbox from "@/Components/UI/InputCheckbox.vue";
import InputSelect from "@/Components/UI/InputSelect.vue";
import ButtonComponent from "@/Components/UI/ButtonComponent.vue";
import TableComponent from "@/Components/UI/TableComponent.vue";
import TablePaginationComponent from "@/Components/UI/TablePaginationComponent.vue";
import CreateModal from "@/Components/Modals/CreateModal.vue";
import LanguageForm from "@/Forms/LanguageForm.vue";
import TranslationForm from "@/Forms/TranslationForm.vue";
import UserForm from "@/Forms/UserForm.vue";
import LanguageCreateModal from "@/Components/Modals/LanguageCreateModal.vue";
import LanguageEditModal from "@/Components/Modals/LanguageEditModal.vue";
import TranslationCreateModal from "@/Components/Modals/TranslationCreateModal.vue";
import TranslationEditModal from "@/Components/Modals/TranslationEditModal.vue";
import UserCreateModal from "@/Components/Modals/UserCreateModal.vue";
import ArticleEditLink from "@/Components/Modals/ArticleEditLink.vue";
import UserEditModal from "@/Components/Modals/UserEditModal.vue";
import DeleteModal from "@/Components/Modals/DeleteModal.vue";
import SoftdeletedWarning from "@/Components/UI/SoftdeletedWarning.vue";
import LanguageFilter from "@/Components/Filters/LanguageFilter.vue";
import Badge from 'primevue/badge';

const pinia = createPinia()
const app = createApp(App);

const currentLanguage = getLanguage();
const i18n = createI18n({
    locale: currentLanguage,
    fallbackLocale: currentLanguage,
    silentTranslationWarn: true // Suppress warnings about missing translations
});
window.i18n = i18n;
loadLanguage(currentLanguage);

app.use(pinia);
app.use(router);
app.use(i18n);
app.use(PrimeVue, {
    pt: {
        button: {
            root: { class: 'box-shadow' }
        },
        inputText: {
            root: { class: 'w-full' }
        },
        dropdown: {
            root: { style: 'width:300px;' },
            panel: {
                style: 'width:calc(300px + 2rem);margin-left: -1rem;',
                class: 'box-shadow'
            },
        }
    }
});

app.mount("#app");

app.component('UnderlineComponent', UnderlineComponent);
app.component('InputText', InputText);
app.component('InputPassword', InputPassword);
app.component('InputCheckbox', InputCheckbox);
app.component('InputSelect', InputSelect);
app.component('ButtonComponent', ButtonComponent);
app.component('TableComponent', TableComponent);
app.component('TablePaginationComponent', TablePaginationComponent);
app.component('CreateModal', CreateModal);
app.component('LanguageCreateModal', LanguageCreateModal);
app.component('TranslationCreateModal', TranslationCreateModal);
app.component('TranslationEditModal', TranslationEditModal);
app.component('UserCreateModal', UserCreateModal);
app.component('UserEditModal', UserEditModal);
app.component('LanguageForm', LanguageForm);
app.component('TranslationForm', TranslationForm);
app.component('UserForm', UserForm);
app.component('LanguageEditModal', LanguageEditModal);
app.component('DeleteModal', DeleteModal);
app.component('SoftdeletedWarning', SoftdeletedWarning);
app.component('LanguageFilter', LanguageFilter);
app.component('Badge', Badge);
app.component('ArticleEditLink', ArticleEditLink);

// WebSocket URL
setCookie('TEST-HEADER', 'someVALUE');
const wsURL = 'wss://localhost/ws';

// Create a WebSocket connection
const socket = new WebSocket(wsURL);
//window.socket = socket;

socket.onerror = function(event) {
    console.error("WebSocket Error:", event);
};
// Event listener for the connection opening
socket.addEventListener('open', (event) => {
    console.log('Connection opened:', event);

    // Send a message to the server once the connection is opened
    socket.send('Hello, WebSocket server!');
    sendMessage('A new message to the server');
});

// Event listener for receiving messages from the server
socket.addEventListener('message', (event) => {
    console.log('Message received from server:', event.data);
});

// Event listener for the connection closing
socket.addEventListener('close', (event) => {
    console.log('Connection closed:', event);
});

// Event listener for any errors
socket.addEventListener('error', (event) => {
    console.error('WebSocket Error:', event);
});

// Function to send messages to the server
function sendMessage(message) {
    if (socket.readyState === WebSocket.OPEN) {
        socket.send(message);
    } else {
        console.error('Cannot send message. WebSocket is not open.');
    }
}
