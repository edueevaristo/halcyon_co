import { computed, ref } from 'vue';
import { defineStore } from 'pinia';
import http from "@/http-common";

export const useAuth = defineStore('auth', () => {

  const token = ref(localStorage.getItem("token"));
  const user = ref((() => {
    try {
      const userData = localStorage.getItem("user");
      if (userData && userData !== 'undefined' && userData !== 'null') {
        // Se for um objeto JSON, parse. Se for string simples, criar objeto
        if (userData.startsWith('{')) {
          return JSON.parse(userData);
        } else {
          return { name: userData, is_premium: false };
        }
      }
      return null;
    } catch {
      return null;
    }
  })());

  function setToken(tokenValue) {
    localStorage.setItem('token', tokenValue);
    token.value = tokenValue;


  }

  function setUser(userValue) {
    if (userValue && typeof userValue === 'object') {
      localStorage.setItem('user', JSON.stringify(userValue));
      user.value = userValue;
    }
  }

  const isAuthenticated = computed(() => {
    return token.value && user.value;
  })

  const isPremium = computed(() => {
    if (!user.value) {
      console.log('🔍 Auth Debug: No user data');
      return false;
    }
    const premium = user.value.is_premium === true || user.value.is_premium === 1;
    console.log('🔍 Auth Debug:', { user: user.value, isPremium: premium });
    return premium;
  })

  async function checkToken() {
    
    try {

      const tokenAuth = 'Bearer ' + token.value;

      const { data } = await http.get("", { //sem url de config do token

        headers: {
          Authorization: tokenAuth,
        },
      });
      return data;
    } catch (error) {

    }
  }

  function clear() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    token.value = '';
    user.value = '';
  }

  async function getUser(id = '') {

    return localStorage.getItem('user');
  }

  return {
    token,
    user,
    setToken,
    setUser,
    checkToken,
    getUser,
    isAuthenticated,
    isPremium,
    clear
  }

})