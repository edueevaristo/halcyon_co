import {createRouter, createWebHistory} from 'vue-router'
import Login from "../pages/Login.vue";
import Home from "../pages/Home.vue";
import Logo from "../pages/Logo.vue";
import Presentation from "../pages/Presentation.vue";
import LandingPage from "../pages/LandingPage.vue";
import ProductInfo from "../pages/ProductInfo.vue";
import Register from "../pages/Register.vue";

const routes = [
    // {
    //     path: '/login',
    //     name: 'Login',
    //     component: Login,
    // },
    // {
    //     path: '/register',
    //     name: 'Registro',
    //     component: Register,
    // },
    {
        path: '/',
        name: 'Landing',
        component: LandingPage,
    },
    {
        path: '/logo',
        name: 'Logo',
        component: Logo,
    },
    {
        path: '/presentation',
        name: 'Presentation',
        component: Presentation,
    }
    // {
    //     path: '/landing',
    //     name: 'Landing',
    //     component: LandingPage,
    // }
    // {
    //     path: '/product/:id',
    //     name: 'product',
    //     component: ProductInfo,
    // }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
