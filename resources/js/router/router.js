import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        redirect: '/dashboard'
    },
    {
        path: "/dashboard",
        component: () => import("../Pages/Dashboard.vue"),
    },
    {
        path: "/upload",
        component: () => import("../Pages/Upload.vue"),
    },


    {
        path: '/:pathMatch(.*)*',
        component: () => import("../Pages/NotFound.vue"),
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});