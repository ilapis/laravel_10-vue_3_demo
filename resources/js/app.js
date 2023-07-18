import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router.js';

import InputText from "@/Form/InputText.vue";
import InputPassword from "@/Form/InputPassword.vue";
import Button from "@/Form/Button.vue";

const app = createApp(App);

app.use(router);
app.mount("#app");

app.component('InputText', InputText);
app.component('InputPassword', InputPassword);
app.component('Button', Button);
