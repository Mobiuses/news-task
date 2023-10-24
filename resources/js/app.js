import {createApp} from 'vue'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { createRouter, createWebHistory } from "vue-router";

const app = createApp(App);
app.use(VueAxios, axios);

const routes = [
    { path: '/', component: () => import('./Components/NewsItemContainer.vue') },
    { path: '/article/:id', component: () => import('./Components/NewsArticle.vue') }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})
app.use(router);
app.mount("#app");
