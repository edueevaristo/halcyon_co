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
          <RouterLink to="/docs" class="link-style"><li>Documentação API</li></RouterLink>
          <AddProduct v-if="isLoggedIn && isPremium" @click="addProdutos" />
        </ul>

        <div class="profile-dropdown">
          <span class="user-profile" @click="toggleDropdown">
            <img 
              :src="userProfileImage || logoIcon" 
              alt="Foto de perfil" 
              class="profile-image"
              @error="handleImageError"
            >
            Olá, {{ userName }} <span v-if="isPremium" class="premium-badge">⭐</span>
            <img src="@/assets/icons/chevron-down.svg" alt="Abrir menu"/>
          </span>
          <ul v-if="showDropdown" class="dropdown-menu">
            <li @click="goToProfile"> 👤 Ver perfil</li>
            <li @click="handleLogout"> 👋 Sair</li>
          </ul>
        </div>
      </div>

      <div v-else class="guest-actions desktop-only">
        <ul class="nav-links">
          <RouterLink to="/landing" class="link-style"><li>O que é a Glittr?</li></RouterLink>
          <RouterLink to="/docs" class="link-style"><li>Documentação API</li></RouterLink>
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
          <RouterLink to="/docs" class="link-style"><li>Documentação API</li></RouterLink>
        </ul>

        <div v-if="isLoggedIn">
          <AddProduct v-if="isLoggedIn && isPremium && showMobileMenu" :hide-button="true" />

          <div class="profile-dropdown">
            <span class="user-profile" @click="toggleDropdown">
              <img 
                :src="userProfileImage || logoIcon" 
                alt="Foto de perfil" 
                class="profile-image"
                @error="handleImageError"
              >
              Olá, {{ userName }} <span v-if="isPremium" class="premium-badge">⭐</span>
              <img src="@/assets/icons/chevron-down.svg" alt="Abrir menu"/>
            </span>
            <ul v-if="showDropdown" class="dropdown-menu">
              <li @click="goToProfile"> 👤 Ver perfil</li>
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
import PostUserDataService from '@/services/PostUserDataService.js';
import LogoIcon from '@/assets/icons/LogoGlittr.svg';

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
      userName: "Usuário",
      userProfileImage: null,
      isPremium: false,
      loginIcon: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="white"/><path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="white"/></svg>',
      logoIcon: LogoIcon
    };
  },
  mounted() {
    this.checkAuthStatus();
  },
  watch: {
    '$route'() {
      this.checkAuthStatus();
    }
  },
  methods: {
    async checkAuthStatus() {

      const token = localStorage.getItem('token');
      this.isLoggedIn = !!token;

      if (token) {

        try {

          const response = await PostUserDataService.getUser(token);
          const user = response.data.me;
          
          this.userName = user.name.split(' ')[0];
          this.isPremium = user.is_premium || false;
          

          if (user.profile_image_url) {
            if (user.profile_image_url.startsWith('http')) {
              this.userProfileImage = user.profile_image_url;
            } else {
              const baseUrl = window.location.hostname === 'localhost'
                ? 'http://127.0.0.1:8000'
                : 'http://3.21.55.156';
              const cleanPath = user.profile_image_url.replace(/^\/storage\//, '');
              this.userProfileImage = `${baseUrl}/storage/${cleanPath}`;
            }
          } else {
            this.userProfileImage = null;
          }

          localStorage.setItem('user', user.name);
          localStorage.setItem('user_id', user.id);
          localStorage.setItem('email', user.email);

        } catch (error) {

          const userData = localStorage.getItem('user');

          if (userData) {

            this.userName = userData.split(' ')[0];

          }
        }
      }
    },
    async handleLogout() {
      try {
        this.showDropdown = false;
        this.showMobileMenu = false;

        localStorage.removeItem('token');
        localStorage.removeItem('user');
        localStorage.removeItem('user_id');
        localStorage.removeItem('email');

        this.isLoggedIn = false;
        this.userProfileImage = null;

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
      this.showDropdown = false;
      this.showMobileMenu = false;
      this.$router.push('/profile');
    },
    login() {
      this.$router.push('/login');
    },
    handleImageError(event) {
      event.target.src = this.logoIcon;
    },
    addProdutos() {

    }
  }
};
</script>

<style scoped>
.header {
  display: flex;
  width: 100%;
  padding: 16px 40px 17px 40px;
  flex-direction: column;
  align-items: center;
  border-width: 1px;
  border-color: #f3f4f6;
  background-color: #141414;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  box-sizing: border-box;
  overflow: visible;
}

.header-container {
  display: flex;
  width: 90%;
  justify-content: space-between;
  align-items: center;
  background-color: #141414;
  overflow: visible;
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
  position: relative;
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
  z-index: 1000;
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

.profile-image {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #e10cff;
  display: block;
  background-color: #f0f0f0;
}

.dropdown-menu {
  position: fixed;
  top: 70px;
  right: 40px;
  background-color: #fff;
  color: #000;
  border: 1px solid #ccc;
  border-radius: 8px;
  list-style: none;
  margin: 0;
  padding: 8px 0;
  z-index: 9999;
  min-width: 160px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  white-space: nowrap;
}

.dropdown-menu li {
  padding: 10px 16px;
  cursor: pointer;
}

.dropdown-menu li:hover {
  background-color: #f3f3f3;
}

.premium-badge {
  color: #FFD700;
  font-size: 16px;
  margin-left: 4px;
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