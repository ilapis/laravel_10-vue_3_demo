import './bootstrap';
import {createApp} from 'vue';
import App from './App.vue';
import router from './router.js';
import {createPinia} from 'pinia';

import CloseIcon from "@/Components/Icons/CloseIcon.vue";

import UnderlineComponent from "@/Components/UI/UnderlineComponent.vue";
import InputText from "@/Components/UI/InputText.vue";
import InputPassword from "@/Components/UI/InputPassword.vue";
import InputCheckbox from "@/Components/UI/InputCheckbox.vue";
import ButtonComponent from "@/Components/UI/ButtonComponent.vue";
import ModalComponent from "@/Components/UI/ModalComponent.vue";
import TableComponent from "@/Components/UI/TableComponent.vue";

import LanguageForm from "@/Forms/LanguageForm.vue";

import LanguageCreateModal from "@/Components/Modals/LanguageCreateModal.vue";
import LanguageEditModal from "@/Components/Modals/LanguageEditModal.vue";
import DeleteModal from "@/Components/Modals/DeleteModal.vue";

const pinia = createPinia()
const app = createApp(App);

app.use(pinia);
app.use(router);
app.mount("#app");

app.component('UnderlineComponent', UnderlineComponent);
app.component('InputText', InputText);
app.component('InputPassword', InputPassword);
app.component('InputCheckbox', InputCheckbox);
app.component('ButtonComponent', ButtonComponent);
app.component('CloseIcon', CloseIcon);
app.component('ModalComponent', ModalComponent);
app.component('TableComponent', TableComponent);
app.component('LanguageCreateModal', LanguageCreateModal);
app.component('LanguageForm', LanguageForm);
app.component('LanguageEditModal', LanguageEditModal);
app.component('DeleteModal', DeleteModal);
