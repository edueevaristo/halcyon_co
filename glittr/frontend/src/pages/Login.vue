<template>
  <main class="login-page">
    <div class="sparkle sparkle-1"></div>
    <div class="sparkle sparkle-2"></div>
    <div class="sparkle sparkle-3"></div>
    <div class="sparkle sparkle-4"></div>
    <div class="sparkle sparkle-5"></div>

    <section class="login-container">
      <div class="login-content">
        <Logo/>

        <LoginForm/>

        <footer class="signup-footer">
          <div class="signup-text">
            <span class="signup-question">Ainda não tem uma conta?</span>
            <RouterLink to="/register" class="signup-link">
              Registre-se
            </RouterLink>
          </div>
        </footer>
      </div>
    </section>
  </main>
</template>

<script>
import Logo from "./Logo.vue";
import LoginFormComponent from "../components/LoginFormComponent.vue";

export default {
  name: "LoginPage",
  components: {
    Logo,
    LoginForm: LoginFormComponent,
  },
};
</script>

<style scoped>
.login-page {
  display: flex;
  height: 100vh;
  width: 100vw;
  justify-content: center;
  align-items: center;
  background: linear-gradient(
      135deg,
      #141414 0%,
      #141414 50%,
      rgba(148, 0, 239) 100%
  );
  position: relative;
}

.sparkle {
  width: 8px;
  height: 8px;
  border-radius: 9999px;
  background-color: #e10cff;
  position: absolute;
}

.sparkle-1 {
  left: 25%;
  top: 25%;
}

.sparkle-2 {
  left: 33%;
  top: 75%;
}

.sparkle-3 {
  left: 75%;
  top: 50%;
}

.sparkle-4 {
  left: 50%;
  top: 33%;
}

.sparkle-5 {
  left: 66%;
  top: 75%;
}

.login-container {
  display: flex;
  width: 448px;
  max-width: 90%;
  flex-direction: column;
  align-items: center;
  border-radius: 16px;
  border-width: 1px;
  border-color: rgba(255, 255, 255, 0.1);
  background-color: rgba(0, 0, 0, 0.3);
  box-shadow: 0 10px 15px -3px rgba(225, 12, 255, 0.1),
  0 4px 6px -4px rgba(225, 12, 255, 0.1);
  backdrop-filter: blur(6px);
}

.login-content {
  display: flex;
  padding: 24px;
  flex-direction: column;
  align-items: flex-start;
  width: 100%;
}

.signup-footer {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 24px;
  width: 100%;
  text-align: center;
}

.signup-text {
  display: flex;
  align-items: center;
  gap: 4px;
}

.signup-question {
  color: #d9d9d9;
  font-family: Poppins, sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 20px;
}

.signup-link {
  color: #e10cff;
  font-family: Poppins, sans-serif;
  font-size: 14px;
  font-weight: 500;
  line-height: 20px;
  cursor: pointer;
}
</style>
