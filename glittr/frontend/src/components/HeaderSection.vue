<template>
  <header class="header">
    <div class="header-container">
      <div class="logo-container">
        <div class="logo-image">
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/54989cd806119e66b348d912bde693d6984a7e84"
            alt="Logo"
          />
        </div>
        <h1 class="logo-text">Glittr</h1>
      </div>
      <button class="login-button">
        <div v-html="loginIcon"></div>
        <span class="login-text">Entrar</span>
      </button>
    </div>
  </header>
</template>

<script>
export default {
  name: "HeaderSection",
  data() {
    return {
      loginIcon: `<svg id="112:807" layer-name="SVG" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]">
<path d="M10 2H12.6667C13.0203 2 13.3594 2.14048 13.6095 2.39052C13.8595 2.64057 14 2.97971 14 3.33333V12.6667C14 13.0203 13.8595 13.3594 13.6095 13.6095C13.3594 13.8595 13.0203 14 12.6667 14H10" stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M6.66602 11.3333L9.99935 7.99996L6.66602 4.66663" stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M10 8H2" stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
    };
  },
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
  box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
}

.header-container {
  display: flex;
  width: 100%;
  max-width: 1280px;
  justify-content: space-between;
  align-items: center;
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
  font-family: Montserrat;
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

.login-text {
  color: #000;
  text-align: center;
  font-family: Poppins;
  font-size: 14px;
  font-weight: 500;
  line-height: 20px;
}
</style>
