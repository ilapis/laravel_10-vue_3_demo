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
        <button @click="logout">Logout</button>
    </div>
</template>

<style scoped>

</style>
