<template>
    <main class="landing-page">
        <div class="sparkle sparkle-1"></div>
        <div class="sparkle sparkle-2"></div>
        <div class="sparkle sparkle-3"></div>
        <div class="sparkle sparkle-4"></div>
        <div class="sparkle sparkle-5"></div>

        <section class="landing-container">
            <div class="landing-content">
                    <img src="@/assets/icons/LogoTexto.png" alt="Glittr logo"  />

                    <div class="headline">
                        <h1>Compare e descubra o melhor<br />em produtos de beleza</h1>
                        <img src="@/assets/icons/beijo.png" alt="beijo" class="beijo-icon" />
                    </div>

                    <h2>Encontre seu match perfeito com avaliações reais e comparações detalhadas.</h2>

                    <div class="button-group">
                        <router-link to="/login" class="btn-primary">
                            <img src="@/assets/icons/sign-in.svg" alt="">Entrar</router-link>

                        <RouterLink to="/register" class="btn-secondary">
                            <img src="@/assets/icons/create-profile.svg" alt="">
                            Criar Conta</RouterLink>
                    </div>

                    <RouterLink to="/">
                      <button class="shine-btn">
                        <span>✨ born to shine</span>
                      </button>
                    </RouterLink>

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
.landing-page {
    display: flex;
    height: 100vh;
    width: 100vw;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #141414 0%, #141414 50%, #9400ef 100%);
    position: relative;
    overflow: hidden;
}

.sparkle {
    width: 6px;
    height: 6px;
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

.landing-container {
    text-align: center;
    padding: 2rem;
    max-width: 640px;
}

.landing-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

.logo {
    width: 64px;
    height: 64px;
}

h1 {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(90deg, #ff007f, #c800ff);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    font-family: 'Poppins', sans-serif;
    line-height: 1.3;
}

h2 {
    color: #ccc;
    font-size: 20px;
    max-width: 480px;
    font-weight: 400;

}

.button-group {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-primary,
.btn-secondary {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    border-radius: 8px;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    border: none;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}

.btn-primary {
    border-radius: 14px;
    background: linear-gradient(90deg, #9400EF 0%, #E10CFF 100%);
    color: white;
}

.btn-secondary {
    border-radius: 14px;
    border: 1px solid rgba(225, 12, 255, 0.50);
    background: #FFF;
    color: #a100ff;
}

.btn-primary:hover {
    background: linear-gradient(90deg, #c800ff, #ff007f);
}

.btn-secondary:hover {
    background: #9400EF;
    color: #FFF;
}

.shine-btn {
    margin-top: 1rem;
    background: transparent;
    border: 1px solid #ccc;
    padding: 0.5rem 1.25rem;
    border-radius: 999px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    color: #ccc;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

a.btn-primary,
a.btn-secondary {
    text-decoration: none;
    gap: 8px;
}


#bj {
    width: 2rem;
    height: 2rem;
}

.headline {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.headline h1 {
    margin: 0;
}

.beijo-icon {
    width: 2rem;
    height: 2rem;
    margin-top: 4px;
}
</style>