import './bootstrap';
import {createApp} from 'vue';
import App from './App.vue';
import router from './router.js';
import {createPinia} from 'pinia';
import {createI18n} from 'vue-i18n';
import {getLanguage, loadLanguage} from './utils';

import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import DownIcon from "@/Components/Icons/DownIcon.vue";
import UpIcon from "@/Components/Icons/UpIcon.vue";
import UnderlineComponent from "@/Components/UI/UnderlineComponent.vue";
import InputText from "@/Components/UI/InputText.vue";
import InputPassword from "@/Components/UI/InputPassword.vue";
import InputCheckbox from "@/Components/UI/InputCheckbox.vue";
import InputSelect from "@/Components/UI/InputSelect.vue";
import ButtonComponent from "@/Components/UI/ButtonComponent.vue";
import ModalComponent from "@/Components/UI/ModalComponent.vue";
import TableComponent from "@/Components/UI/TableComponent.vue";
import TablePaginationComponent from "@/Components/UI/TablePaginationComponent.vue";
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

app.mount("#app");

app.component('UnderlineComponent', UnderlineComponent);
app.component('InputText', InputText);
app.component('InputPassword', InputPassword);
app.component('InputCheckbox', InputCheckbox);
app.component('InputSelect', InputSelect);
app.component('ButtonComponent', ButtonComponent);
app.component('CloseIcon', CloseIcon);
app.component('UpIcon', UpIcon);
app.component('DownIcon', DownIcon);
app.component('ModalComponent', ModalComponent);
app.component('TableComponent', TableComponent);
app.component('TablePaginationComponent', TablePaginationComponent);
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
app.component('ArticleEditLink', ArticleEditLink);
