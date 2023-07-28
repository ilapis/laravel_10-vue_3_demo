import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/Pages/Homepage.vue';
import AdministrationLogin from '@/Pages/Administration/Login.vue';
import AdministrationDashboard from '@/Pages/Administration/Dashboard.vue';
import AdministrationLanguages from '@/Pages/Administration/Languages.vue';
import AdministrationTranslations from '@/Pages/Administration/Translations.vue';
import AdministrationUsers from '@/Pages/Administration/Users.vue';

const routes = [
    { name: 'homepage', path: '/', component: Home },
    { name: 'admin', path: '/admin', component: AdministrationLogin },
    { name: 'admin-dashboard', path: '/admin/dashboard', component: AdministrationDashboard },
    { name: 'admin-languages', path: '/admin/languages', component: AdministrationLanguages },
    { name: 'admin-translations', path: '/admin/translations', component: AdministrationTranslations },
    { name: 'admin-users', path: '/admin/users', component: AdministrationUsers },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
