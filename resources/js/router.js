import { createRouter, createWebHistory } from 'vue-router';
import HomepagePage from '@/Pages/HomepagePage.vue';
import AdministrationLogin from '@/Pages/Administration/LoginPage.vue';
import AdministrationDashboard from '@/Pages/Administration/DashboardPage.vue';
import AdministrationLanguages from '@/Pages/Administration/LanguagesPage.vue';
import AdministrationTranslations from '@/Pages/Administration/TranslationsPage.vue';
import AdministrationUsers from '@/Pages/Administration/UsersPage.vue';

const routes = [
    { name: 'homepage', path: '/', component: HomepagePage },
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
