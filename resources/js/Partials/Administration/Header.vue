<script setup>
import { useRouter } from 'vue-router';
import AuthService from '@/Services/authService.js';

const router = useRouter();
const authService = new AuthService(router);

const logout = async () => {
    await authService.logout();
    localStorage.removeItem('token');
    await router.push({name: 'admin'});
};
</script>

<template>
    <div>
        <!--
        <button class="button border-none bg-primary bg-primary-text line-height-3rem float-right py-4" @click="logout">Logout</button>
        -->
        <ButtonComponent label="Logout" @click="logout" class="btn btn-primary float-right mr-4 mt-4" />
    </div>
</template>

<style scoped>

</style>
