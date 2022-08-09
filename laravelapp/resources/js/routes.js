import Login from './components/Login.vue';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: "/",
        component: ExampleComponent,
        name: 'home',
    },
];

const router = createRouter({
    routes, // short for `routes: routes`
    history: createWebHistory(),
})

export default router;
