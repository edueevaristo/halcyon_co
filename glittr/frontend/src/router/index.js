import {createRouter, createWebHistory} from 'vue-router'
import Login from "../pages/Login.vue";
import Home from "../pages/Home.vue";
import Logo from "../pages/Logo.vue";
import Presentation from "../pages/Presentation.vue";
import LandingPage from "../pages/LandingPage.vue";
import ProductInfo from "../pages/ProductInfo.vue";
import Register from "../pages/Register.vue";
import Profile from "../pages/Profile.vue";

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/register',
        name: 'Registro',
        component: Register,
    },
    {
        path: '/',
        name: 'Home',
        component: Home,
        beforeEnter: (to, from, next) => {
            if (!localStorage.getItem('token')) {
                next('/landing');
            } else {
                next();
            }
        }
    },
    {
        path: '/landing',
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
    },
    {
        path: '/product/:id',
        name: 'product',
        component: ProductInfo,
        beforeEnter: (to, from, next) => {
            if (!localStorage.getItem('token')) {
                next('/landing');
            } else {
                next();
            }
        }
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
        beforeEnter: (to, from, next) => {
            if (!localStorage.getItem('token')) {
                next('/landing');
            } else {
                next();
            }
        }
    },
    {
        path: '/docs',
        name: 'Docs',
        beforeEnter() {
            window.location.href = 'https://docs.glittr.com.br';
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router