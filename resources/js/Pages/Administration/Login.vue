<script setup>
import AdministrationLogin from '@/Layouts/AdministrationLogin.vue';
import {ref, reactive} from "vue";
import { useRouter } from 'vue-router';
import AuthService from '@/Services/authService.js';

const router = useRouter();
const authService = new AuthService(router);

const form = reactive({
    email: '',
    password: '',
});
let response = ref(null);

const login = async () => {
    response.value = await authService.login(form);
};
</script>

<template>
    <AdministrationLogin>
        <div class="box-shadow mt-4 col-12 col-s-10 ml-s-1 col-m-8 ml-m-2 col-l-6 ml-l-3 col-xl-4 ml-xl-4 p-4">
            <h2>Login</h2>
            <InputText
                label="Email"
                :underlineText="(response?.error && response?.errors?.email) ? response.errors.email : ['The email field is required.']"
                v-model="form.email"
            />
            <InputPassword
                label="Password"
                :underlineText="(response?.error && response?.errors?.password) ? response.errors.password : ['The password field is required.']"
                v-model="form.password"
            />
            <ButtonComponent class="btn-primary mt-4" label="Login" @click="login" />
        </div>
    </AdministrationLogin>
</template>

<style scoped>

</style>
