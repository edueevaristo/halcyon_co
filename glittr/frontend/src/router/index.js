import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../components/LoginPage.vue'
import HomeGlittrComponent from '../components/HomeGlittrComponent.vue'
import LogoComponent from '../components/Logo.vue'
import PresentationPage from '../components/PresentationPage.vue'
import LandingPageComponent from '../components/LandingPageComponent.vue'

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
  {
    path: '/logo',
    name: 'Logo',
    component: LogoComponent,
    },
    {
      path: '/presentation',
      name: 'Presentation',
      component: PresentationPage,
    },
    {
      path: '/landing',
      name: 'Landing',
      component: LandingPageComponent,
    }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
