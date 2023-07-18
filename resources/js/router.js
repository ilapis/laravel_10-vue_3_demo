import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/Pages/Homepage.vue';
import AdministrationLogin from '@/Pages/Administration/Login.vue';
import AdministrationDashboard from '@/Pages/Administration/Dashboard.vue';

const routes = [
    { name: 'homepage', path: '/', component: Home },
    { name: 'admin', path: '/admin', component: AdministrationLogin },
    { name: 'admin-dashboard', path: '/admin/dashboard', component: AdministrationDashboard },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
