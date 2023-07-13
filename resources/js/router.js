import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/Pages/Homepage.vue';
import AdministrationLogin from '@/Pages/Administration/Login.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/admin', component: AdministrationLogin },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
