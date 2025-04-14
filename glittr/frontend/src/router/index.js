import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../components/LoginPage.vue'
import HomeGlittrComponent from '../components/HomeGlittrComponent.vue'
import LogoComponent from '../components/Logo.vue'
import PresentationPage from '../components/PresentationPage.vue'
import LandingPageComponent from '../components/LandingPageComponent.vue'
import ProductInfo from "../pages/ProductInfo.vue";
import CadastroPage from "../components/CadastroPage.vue";

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: LoginPage,
  },
  {
    path: '/register',
    name: 'Registro',
    component: CadastroPage,
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
    },
    {
      path: '/product/:id',
      name: 'product',
      component: ProductInfo,
    }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
