require('./bootstrap');

import { createApp } from 'vue'
import * as VueRouter from 'vue-router'

import TestVue from './components/TestVue.vue';
import Login from './components/Login.vue';

const routes = [
    { path: '/', name: 'test', component: TestVue },
    { path: '/login', name: 'login', component: Login },
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes
})

const app = createApp({})

app.use(router);

// app.component('test-vue', TestVue);
// app.component('login-vue', Login);
app.mount('#app');

// export default router;
