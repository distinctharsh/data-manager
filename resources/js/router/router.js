import { createRouter, createWebHistory } from 'vue-router';
import { isAuthenticated } from '../auth'; // Adjust the import path as necessary

const routes = [
    {
        path: '/',
        redirect: (to) => {
            if (isAuthenticated()) {
                return '/dashboard';
            } else {
                return '/login';
            }
        },
    },
    {
        path: '/dashboard',
        component: () => import('../Pages/Dashboard.vue'),
        meta: { requiresAuth: true },
    },
    {
        path: '/upload',
        component: () => import('../Pages/Upload.vue'),
        meta: { requiresAuth: true },
    },
    {
        path: '/login',
        component: () => import('../Pages/Login.vue'),
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('../Pages/NotFound.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard to check authentication
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated()) {
            next({ path: '/login' });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;