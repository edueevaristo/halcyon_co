<template>
  <main class="background">
    <div class="elementos">
      <div class="elemento elemento-1"></div>
      <div class="elemento elemento-2"></div>
      <div class="elemento elemento-3"></div>
      <div class="elemento elemento-4"></div>
      <div class="elemento elemento-5"></div>
    </div>

    <section class="card">
      <header class="header">
        <div class="logo-container">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/78563c8e860c2b1a58a2243db04bcb9e38932f14"
               alt="Glittr Logo" class="logo">
          <h1 class="brand">Gittr</h1>
        </div>
        <h2 class="title">Crie sua conta</h2>
        <p class="subtitle">
          Entre para o universo Gittr e descubra os melhores produtos de beleza!
        </p>
      </header>

      <form class="form" @submit.prevent="submitForm">
        <div class="input-group">
          <label class="label">
            <UserIcon/>
            <span>Nome completo</span>
          </label>
          <input type="text"
                 class="input"
                 name="name"
                 placeholder="Seu nome completo"
                 v-model="form.name">
        </div>

        <div class="input-group">
          <label class="label">
            <EmailIcon/>
            <span>Email</span>
          </label>
          <input type="email"
                 class="input"
                 name="email"
                 placeholder="Nos diga seu melhor e-mail"
                 v-model="form.email">
        </div>

        <div class="input-group">
          <label class="label">
            <PasswordIcon/>
            <span>Senha</span>
          </label>
          <input type="password"
                 class="input"
                 name="password"
                 placeholder="••••••••"
                 v-model="form.password">
        </div>

        <div class="input-group">
          <label class="label">
            <ConfirmIcon/>
            <span>Confirmar senha</span>
          </label>
          <input type="password" class="input" placeholder="••••••••">
        </div>

        <button class="submit-button">
          <UserAddIcon/>
          <span>Criar minha conta</span>
        </button>
      </form>

      <footer class="footer">
        <span>Já é Gittr?</span>
        <a href="#" class="login-link">Entrar</a>
      </footer>
    </section>
  </main>
</template>

<script>

import PostUserDataService from "@/services/PostUserDataService.js";


const UserIcon = {
  template: `
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12.6673 14V12.6667C12.6673 11.9594 12.3864 11.2811 11.8863 10.781C11.3862 10.281 10.7079 10 10.0007 10H6.00065C5.29341 10 4.61513 10.281 4.11503 10.781C3.61494 11.2811 3.33398 11.9594 3.33398 12.6667V14" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M8.00065 7.33333C9.47341 7.33333 10.6673 6.13943 10.6673 4.66667C10.6673 3.19391 9.47341 2 8.00065 2C6.52789 2 5.33398 3.19391 5.33398 4.66667C5.33398 6.13943 6.52789 7.33333 8.00065 7.33333Z" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  `
}

const EmailIcon = {
  template: `
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M13.334 2.66666H2.66732C1.93094 2.66666 1.33398 3.26361 1.33398 3.99999V12C1.33398 12.7364 1.93094 13.3333 2.66732 13.3333H13.334C14.0704 13.3333 14.6673 12.7364 14.6673 12V3.99999C14.6673 3.26361 14.0704 2.66666 13.334 2.66666Z" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M14.6673 4.66666L8.68732 8.46666C8.4815 8.59561 8.24353 8.664 8.00065 8.664C7.75777 8.664 7.5198 8.59561 7.31398 8.46666L1.33398 4.66666" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  `
}

const PasswordIcon = {
  template: `
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M7.68323 1.53C7.71245 1.47097 7.75758 1.42129 7.81353 1.38655C7.86949 1.35181 7.93404 1.3334 7.9999 1.3334C8.06576 1.3334 8.13031 1.35181 8.18626 1.38655C8.24222 1.42129 8.28735 1.47097 8.31656 1.53L9.85656 4.64933C9.95802 4.85465 10.1078 5.03227 10.293 5.16697C10.4782 5.30167 10.6933 5.38941 10.9199 5.42267L14.3639 5.92667C14.4292 5.93612 14.4905 5.96365 14.5409 6.00613C14.5913 6.04862 14.6289 6.10437 14.6492 6.16707C14.6696 6.22978 14.6721 6.29694 14.6563 6.36096C14.6405 6.42498 14.6071 6.4833 14.5599 6.52933L12.0692 8.95467C11.905 9.11473 11.7821 9.31232 11.7111 9.53042C11.6402 9.74852 11.6233 9.98059 11.6619 10.2067L12.2499 13.6333C12.2614 13.6986 12.2544 13.7657 12.2296 13.8271C12.2048 13.8885 12.1632 13.9417 12.1096 13.9807C12.056 14.0196 11.9926 14.0427 11.9265 14.0473C11.8604 14.0519 11.7944 14.0378 11.7359 14.0067L8.65723 12.388C8.45438 12.2815 8.22868 12.2258 7.99956 12.2258C7.77044 12.2258 7.54475 12.2815 7.3419 12.388L4.2639 14.0067C4.20545 14.0376 4.1395 14.0515 4.07353 14.0468C4.00757 14.0421 3.94424 14.019 3.89076 13.9801C3.83728 13.9413 3.79579 13.8881 3.771 13.8268C3.74622 13.7655 3.73914 13.6985 3.75056 13.6333L4.3379 10.2073C4.3767 9.98116 4.35989 9.74893 4.28892 9.5307C4.21796 9.31246 4.09497 9.11477 3.93056 8.95467L1.4399 6.53C1.39229 6.48402 1.35856 6.4256 1.34254 6.36138C1.32652 6.29717 1.32886 6.22975 1.34928 6.16679C1.36971 6.10384 1.40741 6.04789 1.45808 6.00532C1.50876 5.96275 1.57037 5.93527 1.6359 5.926L5.07923 5.42267C5.30607 5.38967 5.52149 5.30204 5.70695 5.16733C5.89242 5.03261 6.04237 4.85485 6.1439 4.64933L7.68323 1.53Z" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  `
}

const ConfirmIcon = {
  template: `
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M6.6243 10.3333C6.56478 10.1026 6.44453 9.89206 6.27605 9.72358C6.10757 9.5551 5.89702 9.43485 5.6663 9.37533L1.5763 8.32066C1.50652 8.30085 1.44511 8.25883 1.40138 8.20096C1.35765 8.14309 1.33398 8.07253 1.33398 7.99999C1.33398 7.92746 1.35765 7.8569 1.40138 7.79903C1.44511 7.74116 1.50652 7.69913 1.5763 7.67933L5.6663 6.62399C5.89693 6.56453 6.10743 6.44438 6.2759 6.27602C6.44438 6.10766 6.56468 5.89725 6.6243 5.66666L7.67897 1.57666C7.69857 1.50661 7.74056 1.44489 7.79851 1.40092C7.85647 1.35696 7.92722 1.33316 7.99997 1.33316C8.07271 1.33316 8.14346 1.35696 8.20142 1.40092C8.25938 1.44489 8.30136 1.50661 8.32097 1.57666L9.37497 5.66666C9.43449 5.89737 9.55474 6.10792 9.72322 6.27641C9.8917 6.44489 10.1023 6.56514 10.333 6.62466L14.423 7.67866C14.4933 7.69806 14.5553 7.74 14.5995 7.79804C14.6437 7.85609 14.6677 7.92703 14.6677 7.99999C14.6677 8.07295 14.6437 8.1439 14.5995 8.20194C14.5553 8.25999 14.4933 8.30193 14.423 8.32133L10.333 9.37533C10.1023 9.43485 9.8917 9.5551 9.72322 9.72358C9.55474 9.89206 9.43449 10.1026 9.37497 10.3333L8.3203 14.4233C8.3007 14.4934 8.25871 14.5551 8.20075 14.5991C8.1428 14.643 8.07205 14.6668 7.9993 14.6668C7.92656 14.6668 7.85581 14.643 7.79785 14.5991C7.73989 14.5551 7.69791 14.4934 7.6783 14.4233L6.6243 10.3333Z" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M13.334 2V4.66667" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M14.6667 3.33334H12" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M2.66602 11.3333V12.6667" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M3.33333 12H2" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  `
}

const UserAddIcon = {
  template: `
    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M11.1673 14V12.6667C11.1673 11.9594 10.8864 11.2811 10.3863 10.781C9.88617 10.281 9.2079 10 8.50065 10H4.50065C3.79341 10 3.11513 10.281 2.61503 10.781C2.11494 11.2811 1.83398 11.9594 1.83398 12.6667V14" stroke="#F8FAFC" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M6.50065 7.33333C7.97341 7.33333 9.16732 6.13943 9.16732 4.66667C9.16732 3.19391 7.97341 2 6.50065 2C5.02789 2 3.83398 3.19391 3.83398 4.66667C3.83398 6.13943 5.02789 7.33333 6.50065 7.33333Z" stroke="#F8FAFC" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M13.166 5.33333V9.33333" stroke="#F8FAFC" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M15.166 7.33333H11.166" stroke="#F8FAFC" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  `
}

export default {
  components: {
    UserIcon,
    EmailIcon,
    PasswordIcon,
    ConfirmIcon,
    UserAddIcon
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
      }
    }
  },
  methods: {
    async submitForm() {
      try {
        const response = await PostUserDataService.create(this.form)
        console.log("Usuário cadastrado com sucesso:", response.data)
        // TODO: Redirecionar para a tela de login, validar com a Amanda se terá algo "animado" após ações, ex: sweetalert.

      } catch (error) {
        console.error("Erro ao cadastrar usuário:", error.response?.data || error.message)
      }
    }
  }
}
</script>


<style scoped>
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
}

.background {
  display: flex;
  min-height: 100vh;
  width: 100%;
  padding: 0;
  justify-content: center;
  align-items: center;
  background: linear-gradient(
      135deg,
      #141414 0%,
      #141414 50%,
      rgba(148, 0, 239) 100%
  );
  position: relative;
  overflow: hidden;
}

.elemento {
  width: 8px;
  height: 8px;
  border-radius: 9999px;
  position: absolute;
  background-color: #e10cff;
}

.elemento-1 {
  left: 25%;
  top: 25%;
}

.elemento-2 {
  left: 33.33%;
  top: 75%;
}

.elemento-3 {
  left: 75%;
  top: 50%;
}

.elemento-4 {
  left: 50%;
  top: 33.33%;
}

.elemento-5 {
  left: 66.67%;
  top: 75%;
}

.card {
  width: 100%;
  max-width: 448px;
  margin: 20px;
  padding: 24px;
  border-radius: 16px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(6px);
  box-shadow: 0px 10px 15px -3px rgba(225, 12, 255, 0.1),
  0px 4px 6px -4px rgba(225, 12, 255, 0.1);
  background-color: rgba(0, 0, 0, 0.3);
  box-sizing: border-box;
}

.header {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  margin-bottom: 24px;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo {
  width: 30px;
  height: 30px;
}

.brand {
  background: linear-gradient(90deg, #9400ef 0%, #e10cff 50%, #ed008c 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  font: 700 24px "Ubuntu", sans-serif;
  margin: 0;
}

.title {
  background: linear-gradient(90deg, #9400ef 0%, #e10cff 50%, #ed008c 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  text-align: center;
  font: 700 24px "Poppins", sans-serif;
  margin: 0;
}

.subtitle {
  color: #a1a1aa;
  text-align: center;
  font: 14px "Poppins", sans-serif;
  margin: 0;
}

.form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  width: 100%;
}

.input-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
  width: 100%;
}

.label {
  display: flex;
  align-items: center;
  gap: 4px;
  color: #d4d4d8;
  font: 14px "Poppins", sans-serif;
}

.input {
  padding: 12px 16px;
  border-radius: 14px;
  border: 1px solid rgba(225, 12, 255, 0.2);
  color: #fff;
  background-color: rgba(255, 255, 255, 0.05);
  font: 14px "Poppins", sans-serif;
  width: 100%;
  box-sizing: border-box;
  outline: none;
}

.input::placeholder {
  color: #64748b;
}

.submit-button {
  height: 48px;
  padding: 8px 16px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  border-radius: 30px;
  background: linear-gradient(90deg, #ed008c 0%, #e10cff 100%);
  border: none;
  color: #f8fafc;
  cursor: pointer;
  font: 14px "Poppins", sans-serif;
  width: 100%;
  margin-top: 16px;
  transition: transform 0.2s, box-shadow 0.2s;
}

.submit-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(225, 12, 255, 0.2);
}

.footer {
  padding: 24px 0 0;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 4px;
}

.login-link {
  color: #e10cff;
  cursor: pointer;
  font: 14px "Poppins", sans-serif;
  text-decoration: none;
  transition: color 0.2s;
}

.login-link:hover {
  color: #ff4af8;
}

@media (max-width: 480px) {
  .card {
    margin: 16px;
    padding: 20px;
  }

  .header {
    margin-bottom: 20px;
  }
}
</style>