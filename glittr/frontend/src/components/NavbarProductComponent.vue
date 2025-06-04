<template>
  <nav class="navbar">
    <div class="navbar-content">
      <div class="logo">
        <img src="@/assets/icons/LogoTexto.png" alt="Logo"/>
      </div>

      <div v-if="isLoggedIn" class="user-section">
<!--        <button class="add-product-button" @click="navigateToAddProduct">-->
<!--          <img src="@/assets/icons/add.svg" alt="Adicionar produto">-->
<!--          <span>Adicionar produto</span>-->
<!--        </button>-->

        <div class="profile-dropdown">
          <span class="user-profile" @click="toggleDropdown">
            <img :src="userAvatar" alt="Ícone de usuário" class="user-avatar">
            <span class="user-name">Olá, {{ userName }}</span>
            <img src="@/assets/icons/chevron-down.svg" alt="Menu" class="dropdown-icon">
          </span>
          <ul v-if="showDropdown" class="dropdown-menu">
            <li @click="handleLogout">👋 Sair</li>
          </ul>
        </div>
      </div>

      <button v-else class="login-button" @click="navigateToLogin">
        <img src="@/assets/icons/arrow.svg" alt="Ícone de seta" class="icon"/>
        Entrar
      </button>
    </div>
  </nav>
</template>

<script>

import bebeAvatar from "@/assets/icons/bebe.png";

export default {
  name: "NavbarProductComponent",
  data() {
    return {
      isLoggedIn: false,
      userName: "Usuário",
      userAvatar: bebeAvatar,
      showDropdown: false
    };
  },
  mounted() {
    this.checkAuthStatus();
  },
  methods: {
    checkAuthStatus() {
      const token = localStorage.getItem('token');
      this.isLoggedIn = !!token;

      const userData = localStorage.getItem('user');
      if (userData) {
        this.userName = userData.split(' ')[0];
      }
    },
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    handleLogout() {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      this.isLoggedIn = false;
      this.$router.push('/login');
    },
    navigateToLogin() {
      this.$router.push('/login');
    },
    navigateToAddProduct() {
      this.$router.push('/add-product');
    }
  }
};
</script>

<style scoped>
.navbar {
  display: flex;
  width: 100%;
  padding: 16px 40px 17px 40px;
  flex-direction: column;
  align-items: center;
  border-bottom: 1px solid #F3F4F6;
  background: #141414;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.navbar-content {
  display: flex;
  width: 1280px;
  max-width: 1280px;
  justify-content: space-between;
  align-items: center;
}

.logo img {
  height: 40px;
}

.login-button {
  display: flex;
  height: 40px;
  padding: 9px 17px;
  justify-content: center;
  align-items: center;
  gap: 8px;
  border-radius: 14px;
  border: 1px solid #9400EF;
  background: #FFF;
  color: #000000;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s ease;
}

.login-button:hover {
  background: #f2e6ff;
}

.login-button .icon {
  width: 16px;
  height: 16px;
}

.user-section {
  display: flex;
  align-items: center;
  gap: 20px;
}

.add-product-button {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: linear-gradient(90deg, #ED008C 0%, #B33974 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  cursor: pointer;
  transition: transform 0.2s;
}

.add-product-button:hover {
  transform: translateY(-2px);
}

.add-product-button img {
  width: 16px;
  height: 16px;
}

.profile-dropdown {
  position: relative;
}

.user-profile {
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
}

.user-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
}

.user-name {
  color: #FFF;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
}

.dropdown-icon {
  width: 16px;
  height: 16px;
  transition: transform 0.2s;
}

.profile-dropdown:hover .dropdown-icon {
  transform: rotate(180deg);
}

.dropdown-menu {
  position: absolute;
  right: 0;
  top: 100%;
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  list-style: none;
  padding: 8px 0;
  min-width: 160px;
  z-index: 100;
  margin-top: 8px;
}

.dropdown-menu li {
  padding: 8px 16px;
  color: #333;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  cursor: pointer;
}

.dropdown-menu li:hover {
  background: #f5f5f5;
}

@media (max-width: 768px) {
  .navbar {
    padding: 16px 20px;
  }

  .user-section {
    gap: 12px;
  }

  .user-name {
    display: none;
  }

  .add-product-button span {
    display: none;
  }

  .add-product-button {
    padding: 8px;
    border-radius: 50%;
  }
}
</style>