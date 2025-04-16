<template>
  <header class="brand-header">
    <div class="logo-container">
      <div class="logo-wrapper">
        <img src="/src/assets/icons/LogoTexto.png" alt="">
      </div>
      <div class="brand-name-wrapper">
      </div>
    </div>
    <h2 class="login-heading">Entrar para continuar brilhando ✨</h2>
    <p class="login-subheading">
      Seu universo de beleza personalizada te espera.
    </p>
  </header>
</template>

<script>
export default {
  name: "Logo",
};
</script>

<style scoped>
.brand-header {
  display: flex;
  padding: 10px 0px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 10px;
  width: 100%;
}

.logo-container {
  display: flex;
  height: 48px;
  align-items: center;
}

.logo-wrapper {
  display: flex;
  width: 30px;
  height: 30px;
  justify-content: center;
  align-items: center;
}

.logo-image {
  width: 30px;
  height: 30px;
}

.brand-name-wrapper {
  padding-left: 8px;
}

.brand-name {
  text-align: center;
  font-family: Ubuntu, sans-serif;
  font-size: 24px;
  font-weight: 700;
  line-height: 32px;
  background: linear-gradient(90deg, #ed008c 0%, #e10cff 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  margin: 0;
}

.login-heading {
  text-align: center;
  font-family: Poppins, sans-serif;
  font-size: 24px;
  font-weight: 700;
  line-height: 32px;
  letter-spacing: -0.6px;
  background: linear-gradient(90deg, #ed008c 0%, #e10cff 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  margin: 0;
}

.login-subheading {
  color: #a1a1aa;
  text-align: center;
  font-family: Poppins, sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 20px;
  margin: 0;
}
</style>
