<template>
  <form class="login-form">
    <FormInput
      type="email"
      id="email"
      placeholder="seu@email.com"
      label="Email"
      :icon="emailIcon"
    />

    <FormInput
      type="password"
      id="password"
      placeholder="••••••••"
      label="Senha"
      :icon="passwordIcon"
      :forgotPassword="true"
    />

    <button type="submit" class="login-button">
      <div class="button-icon" v-html="loginIcon"></div>
      <span class="button-text">Acessar minha conta</span>
    </button>
  </form>
</template>

<script>
import FormInput from "./FormInput.vue";

export default {
  name: "LoginForm",
  components: {
    FormInput,
  },
  data() {
    return {
      emailIcon: `<svg id="112:584" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px] text-[#E10CFF]">
<path d="M13.334 2.66666H2.66732C1.93094 2.66666 1.33398 3.26361 1.33398 3.99999V12C1.33398 12.7364 1.93094 13.3333 2.66732 13.3333H13.334C14.0704 13.3333 14.6673 12.7364 14.6673 12V3.99999C14.6673 3.26361 14.0704 2.66666 13.334 2.66666Z" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M14.6673 4.66666L8.68732 8.46666C8.4815 8.59561 8.24353 8.664 8.00065 8.664C7.75777 8.664 7.5198 8.59561 7.31398 8.46666L1.33398 4.66666" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
      passwordIcon: `<svg id="112:593" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px] text-[#E10CFF]">
<path d="M7.68323 1.53C7.71245 1.47097 7.75758 1.42129 7.81353 1.38655C7.86949 1.35181 7.93404 1.3334 7.9999 1.3334C8.06576 1.3334 8.13031 1.35181 8.18626 1.38655C8.24222 1.42129 8.28735 1.47097 8.31656 1.53L9.85656 4.64933C9.95802 4.85465 10.1078 5.03227 10.293 5.16697C10.4782 5.30167 10.6933 5.38941 10.9199 5.42267L14.3639 5.92667C14.4292 5.93612 14.4905 5.96365 14.5409 6.00613C14.5913 6.04862 14.6289 6.10437 14.6492 6.16707C14.6696 6.22978 14.6721 6.29694 14.6563 6.36096C14.6405 6.42498 14.6071 6.4833 14.5599 6.52933L12.0692 8.95467C11.905 9.11473 11.7821 9.31232 11.7111 9.53042C11.6402 9.74852 11.6233 9.98059 11.6619 10.2067L12.2499 13.6333C12.2614 13.6986 12.2544 13.7657 12.2296 13.8271C12.2048 13.8885 12.1632 13.9417 12.1096 13.9807C12.056 14.0196 11.9926 14.0427 11.9265 14.0473C11.8604 14.0519 11.7944 14.0378 11.7359 14.0067L8.65723 12.388C8.45438 12.2815 8.22868 12.2258 7.99956 12.2258C7.77044 12.2258 7.54475 12.2815 7.3419 12.388L4.2639 14.0067C4.20545 14.0376 4.1395 14.0515 4.07353 14.0468C4.00757 14.0421 3.94424 14.019 3.89076 13.9801C3.83728 13.9413 3.79579 13.8881 3.771 13.8268C3.74622 13.7655 3.73914 13.6985 3.75056 13.6333L4.3379 10.2073C4.3767 9.98116 4.35989 9.74893 4.28892 9.5307C4.21796 9.31246 4.09497 9.11477 3.93056 8.95467L1.4399 6.53C1.39229 6.48402 1.35856 6.4256 1.34254 6.36138C1.32652 6.29717 1.32886 6.22975 1.34928 6.16679C1.36971 6.10384 1.40741 6.04789 1.45808 6.00532C1.50876 5.96275 1.57037 5.93527 1.6359 5.926L5.07923 5.42267C5.30607 5.38967 5.52149 5.30204 5.70695 5.16733C5.89242 5.03261 6.04237 4.85485 6.1439 4.64933L7.68323 1.53Z" stroke="#E10CFF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
      loginIcon: `<svg id="I112:600;89:299" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px] text-[#F8FAFC]">
<path d="M10.5 2H13.1667C13.5203 2 13.8594 2.14048 14.1095 2.39052C14.3595 2.64057 14.5 2.97971 14.5 3.33333V12.6667C14.5 13.0203 14.3595 13.3594 14.1095 13.6095C13.8594 13.8595 13.5203 14 13.1667 14H10.5" stroke="#F8FAFC" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M7.16602 11.3333L10.4993 7.99999L7.16602 4.66666" stroke="#F8FAFC" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M10.5 8H2.5" stroke="#F8FAFC" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
    };
  },
};
</script>

<style scoped>
.login-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  width: 90%;
  padding: 0px 9px;
}

.login-button {
  display: flex;
  height: 40px;
  justify-content: center;
  align-items: center;
  gap: 8px;
  border-radius: 30px;
  background: linear-gradient(90deg, #ed008c 0%, #e10cff 100%);
  border: none;
  cursor: pointer;
  margin:0;
}

.button-text {
  color: #f8fafc;
  text-align: center;
  font-family: Poppins, sans-serif;
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
}
</style>
