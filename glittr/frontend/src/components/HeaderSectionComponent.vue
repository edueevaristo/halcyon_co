<template>
  <header class="header">
    <div class="header-container">
      <div class="logo-container">
        <!-- Botão de menu hambúrguer para mobile -->
        <button class="mobile-menu-button" @click="toggleMobileMenu">
          <img src="@/assets/icons/menu.svg" alt="Abrir menu"/>
        </button>

        <div class="logo-image">
          <img src="@/assets/icons/LogoGlittr.svg" alt="Logo da Glittr. Uma Estrela rosa.">
        </div>
      </div>

      <!-- Menu normal desktop -->
      <div v-if="isLoggedIn" class="user-actions desktop-only">
        <ul class="nav-links">
          <RouterLink to="/landing" class="link-style"><li>O que é a Glittr?</li></RouterLink>
          <RouterLink to="/" class="link-style"><li>Comparador</li></RouterLink>
          <RouterLink to="/" class="link-style"><li>Produtos</li></RouterLink>
          <AddProduct v-if="isLoggedIn" @click="addProdutos" />
        </ul>

        <div class="profile-dropdown">
          <span class="user-profile" @click="toggleDropdown">
            <img src="@/assets/icons/LogoGlittr.svg" alt="Ícone de usuário.">
            Olá, {{ userName }}
            <img src="@/assets/icons/chevron-down.svg" alt="Abrir menu"/>
          </span>
          <ul v-if="showDropdown" class="dropdown-menu">
<!--            <li @click="goToProfile"> 👤 Ver perfil</li>-->
            <li @click="handleLogout"> 👋 Sair</li>
          </ul>
        </div>
      </div>

      <div v-else class="guest-actions desktop-only">
        <ul class="nav-links">
          <RouterLink to="/landing" class="link-style"><li>O que é a Glittr?</li></RouterLink>
          <RouterLink to="/" class="link-style"><li>Comparador</li></RouterLink>
          <RouterLink to="/" class="link-style"><li>Produtos</li></RouterLink>
        </ul>

        <RouterLink to="/presentation" class="CTA-Login">
          <div v-html="loginIcon"></div>
          <span class="login-text">Começar agora</span>
          <img src="@/assets/icons/chevron-right.svg" alt="Seta pra direita.">
        </RouterLink>
      </div>
    </div>

    <!-- MENU MOBILE ANIMADO -->
    <transition name="slide-fade">
      <div v-if="showMobileMenu" class="mobile-menu">
        <ul class="nav-links">
          <RouterLink to="/landing" class="link-style"><li>O que é a Glittr?</li></RouterLink>
          <li>Comparador</li>
          <RouterLink to="/" class="link-style"><li>Produtos</li></RouterLink>
        </ul>

        <div v-if="isLoggedIn">
          <AddProduct v-if="isLoggedIn && showMobileMenu" :hide-button="true" />

          <div class="profile-dropdown">
            <span class="user-profile" @click="toggleDropdown">
              <img src="@/assets/icons/LogoGlittr.svg" alt="Ícone de usuário.">
              Olá, {{ userName }}
              <img src="@/assets/icons/chevron-down.svg" alt="Abrir menu"/>
            </span>
            <ul v-if="showDropdown" class="dropdown-menu">
<!--              <li @click="goToProfile"> 👤 Ver perfil</li>-->
              <li @click="handleLogout"> 👋 Sair</li>
            </ul>
          </div>
        </div>

        <div v-else>
          <button class="CTA-Login" @click="login">
            <div v-html="loginIcon"></div>
            <span class="login-text">Começar agora</span>
            <img src="@/assets/icons/chevron-right.svg" alt="Seta pra direita.">
          </button>
        </div>
      </div>
    </transition>
  </header>
</template>

<script>

import RegisterProductsModalComponent from '../components/RegisterProductsModalComponent.vue';

export default {
  name: "HeaderSection",
  components: {
    AddProduct: RegisterProductsModalComponent
  },
  data() {
    return {
      isLoggedIn: false,
      showDropdown: false,
      showMobileMenu: false,
      userName: "Usuário"
    };
  },
  mounted() {
    this.checkAuthStatus();
  },
  methods: {
    async checkAuthStatus() {

      const token = localStorage.getItem('token');
      this.isLoggedIn = !!token;

      const userData = localStorage.getItem('user');

      if (userData) {
        this.userName = userData.split(' ')[0];
      }
    },
    async handleLogout() {
      try {

        localStorage.removeItem('token');
        localStorage.removeItem('user');
        localStorage.removeItem('user_id');
        localStorage.removeItem('email');

        this.isLoggedIn = false;
        this.showDropdown = false;
        this.showMobileMenu = false;

        this.$router.push('/login');

      } catch (error) {

        console.error('Erro ao fazer logout:', error);
      }
    },
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    toggleMobileMenu() {
      this.showMobileMenu = !this.showMobileMenu;
      this.showDropdown = false;
    },
    goToProfile() {
      this.$router.push('/profile');
    },
    login() {
      this.$router.push('/login');
    }
  }
};
</script>

<style scoped>
.header {
  display: flex;
  width: 100vw;
  padding: 16px 40px 17px 40px;
  flex-direction: column;
  align-items: center;
  border-width: 1px;
  border-color: #f3f4f6;
  background-color: #141414;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.header-container {
  display: flex;
  width: 90%;
  justify-content: space-between;
  align-items: center;
  background-color: #141414;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo-image {
  display: flex;
  width: 29px;
  height: 29px;
  justify-content: center;
  align-items: center;
}

.logo-text {
  color: #ed008c;
  font-family: 'Montserrat', sans-serif;
  font-size: 24px;
  font-weight: 700;
  line-height: 32px;
  margin: 0;
}

.login-button {
  display: flex;
  height: 40px;
  padding: 9px 17px;
  justify-content: center;
  align-items: center;
  gap: 8px;
  border-radius: 14px;
  border-width: 1px;
  border-color: #9400ef;
  background-color: #fff;
  cursor: pointer;
}

.link-style {
  text-decoration: none;
  color: #fff;
}

.login-text {
  color: #fff;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 500;
  line-height: 20px;
}

.guest-actions,
.user-actions {
  display: inline-flex;
  flex-direction: row;
  gap: 30px;
  justify-content: center;
  align-items: center;
}

.CTA-Login {
  display: flex;
  width: 209px;
  height: 44px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 10px;
  background: linear-gradient(90deg, #ED008C 0%, #9400EF 100%);
  border: none;
}

.nav-links {
  display: inline-flex;
  flex-direction: row;
  list-style: none;
  color: #fff;
  gap: 45px;
  font-size: 16px;
  justify-content: center;
  align-items: center;
}

li:hover {
  color: #9400ef;
  cursor: pointer;
}

.CTA-AddProdutos {
  display: flex;
  height: 44px;
  padding: 15px 20px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 10px;
  background: linear-gradient(90deg, #ED008C 0%, #B33974 100%);
  border: none;
}

.profile-dropdown {
  position: relative;
  cursor: pointer;
}

.user-profile {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: #fff;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  right: 0;
  background-color: #fff;
  color: #000;
  border: 1px solid #ccc;
  border-radius: 8px;
  list-style: none;
  margin-top: 8px;
  padding: 8px 0;
  z-index: 1000;
  min-width: 160px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.dropdown-menu li {
  padding: 10px 16px;
  cursor: pointer;
}

.dropdown-menu li:hover {
  background-color: #f3f3f3;
}

/* Oculta elementos no mobile */
.desktop-only {
  display: flex;
}

.mobile-menu-button {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
}

/* MENU MOBILE */
.mobile-menu {
  display: flex;
  flex-direction: column;
  gap: 16px;
  padding: 16px 0;
  width: 100%;
  background-color: #141414;
  color: white;
  border-top: 1px solid #333;
}

/* Animação */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

/* Responsivo */
@media (max-width: 768px) {
  .nav-links {
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
  }

  .desktop-only {
    display: none;
  }

  .mobile-menu-button {
    display: block;
  }
}
</style>