import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router.js';
import { createPinia } from 'pinia';

import InputText from "@/Form/InputText.vue";
import InputPassword from "@/Form/InputPassword.vue";
import Button from "@/Form/Button.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import ModalComponent from "@/Components/UI/ModalComponent.vue";
import LanguageCreateModal from "@/Components/Modals/LanguageCreateModal.vue";

const pinia = createPinia()
const app = createApp(App);

app.use(pinia);
app.use(router);
app.mount("#app");

app.component('InputText', InputText);
app.component('InputPassword', InputPassword);
app.component('Button', Button);
app.component('CloseIcon', CloseIcon);
app.component('ModalComponent', ModalComponent);
app.component('LanguageCreateModal', LanguageCreateModal);
