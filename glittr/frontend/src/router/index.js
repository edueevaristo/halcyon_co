import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../components/LoginPage.vue'
import HomeGlittrComponent from '../components/HomeGlittrComponent.vue'

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: LoginPage,
  },
  {
    path: '/',
    name: 'Home',
    component: HomeGlittrComponent,
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
