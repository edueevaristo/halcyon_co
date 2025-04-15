<template>
  <div class="landing-page">
    <header class="header">
      <HeaderSection />
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <div class="badge">
          <img
            src="/src/assets/icons/LogoGlittr.svg"
            alt="Logo da Glittr. Uma estrela rosa."
            id="logo"
          />
          <p>Faça parte da nossa comunidade brilhante ✨</p>
        </div>
        <h1>Compare. Descubra. <shine>Brilhe.</shine></h1>
        <p>
          O Glittr te ajuda a encontrar os melhores produtos de beleza com
          comparações reais e avaliações honestas.
        </p>
        <div class="cta-buttons">
          <button class="primary-button">
            Começar agora
            <img src="/src/assets/icons/chevron-right.svg" alt="" />
          </button>
          <button class="secondary-button">Como funciona</button>
        </div>
      </div>
      <div class="hero-image">
        <!-- Placeholder para a imagem principal -->
      </div>
    </section>

    <MarqueeSlider />

    <!-- Features Section -->
    <section class="features">
      <h2>
        Compare o que <span class="highlight-pink"> realmente importa </span>
      </h2>
      <div class="feature-cards">
        <div class="feature-card">
          <span class="emoji"
            ><img src="/src/assets/icons/solar_heart-bold-duotone.svg" alt=""
          /></span>
          <p>Veja feedbacks reais de outras entusiastas de beauty & glam ✨</p>
        </div>
        <div class="feature-card">
          <span class="emoji"
            ><img src="/src/assets/icons/mingcute_love-fill.svg" alt=""
          /></span>
          <p>
            Compare as características dos produtos para encontrar sua
            combinação perfeita 💘
          </p>
        </div>
        <div class="feature-card">
          <span class="emoji"
            ><img src="/src/assets/icons/solar_card-bold.svg" alt=""
          /></span>
          <p>
            Encontre os produtos com o melhor custo-benefício que se encaixam no
            seu orçamento 💰
          </p>
        </div>
      </div>
    </section>

    <!-- Como Funciona Section -->
    <section class="how-it-works">
      <h2>Como <span class="highlight">funciona?</span></h2>
      <p class="subtitle">
        Encontrar os seus matches de beleza nunca foi tão fácil.
      </p>

      <div class="steps">
        <div class="step">
          <div class="step-icon search">
            <img src="/src/assets/icons/search.svg" alt="" />
          </div>
          <h3>Busque cosméticos</h3>
          <p>Procure seus produtos de beleza favoritos</p>
        </div>

        <div class="step">
          <div class="step-icon compare">
            <img src="/src/assets/icons/compare.svg" alt="" />
          </div>
          <h3>Compare até 2 produtos</h3>
          <p>Veja comparações lado a lado para tomar a melhor decisão</p>
        </div>
        <div class="step">
          <div class="step-icon choose">
            <img src="/src/assets/icons/buy.svg" alt="" />
          </div>
          <h3>Faça escolhas melhores</h3>
          <p>Escolha produtos que realmente combinam com você</p>
        </div>
        <div class="step">
          <div class="step-icon share">
            <img src="/src/assets/icons/like.svg" alt="" />
          </div>
          <h3>Influencie & receba conselhos</h3>
          <p>Faça parte da comunidade Glittr para descobrir e compartilhar</p>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="cta-card">
        <div class="text-section">
          <div class="badge">
            <img src="/src/assets/icons/LogoGlittr.svg" alt="" id="logo" />
            Faça parte da nossa comunidade brilhante ✨
          </div>
          <p class="CTA-Text">
            pront@ pra dar seu <span class="highlight-cta">beauty match?</span>
          </p>
          <p style="color: #141414">
            Junte-se a uma comunidade incrível de beauty lovers online! 💄
          </p>
          <router-link to="/presentation" class="primary-button">
            <div v-html="loginIcon"></div>
            <span class="login-text">Começar agora </span>
            <img
              src="/src/assets/icons/chevron-right.svg"
              alt="Seta pra direita."
            />
          </router-link>
        </div>

        <div class="img-section">
          <img src="/src/assets/images/imgCTA.svg" alt="" />
        </div>
      </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
      <div class="newsletter-content">
        <div class="text-content">
          <h2 style="color: #fff !important; margin-bottom: 10px">
            Brilhe mais com a Glittr 💖
          </h2>
          <p>
            Inscreva-se para receber novidades exclusivas de beauty & tech do
            universo da Glittr!
          </p>
          <section style="display: inline-flex; gap: 15px">
            <div class="newsletter-form">
              <input type="email" placeholder="Seu melhor e-mail 💌" />
            </div>
            <button class="send-button">Inscrever-se</button>
          </section>
          <small>Não enviaremos spam. Prometemos! 💅 </small>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="footer-content">
        <div class="footer-logo">
          <section style="display: inline-flex; gap: 15px; margin: 0">
            <img src="/src/assets/icons/LogoGlittr.svg" alt="Glittr" />
            <p class="brand-name">Glittr</p>
          </section>
          <div class="social-links">
            <a href="#"><img src="/src/assets/icons/x.svg" alt="" /></a>
            <a href="#"><img src="/src/assets/icons/instagram.svg" alt="" /></a>
            <a href="#"><img src="/src/assets/icons/youtube.svg" alt="" /></a>
            <a href="#"><img src="/src/assets/icons/tiktok.svg" alt="" /></a>
          </div>
        </div>
        <div class="footer-links">
          <div class="footer-section">
            <h4>Plataforma</h4>
            <a href="#">Como funciona</a>
          </div>
          <div class="footer-section">
            <h4>Comparador</h4>
            <a href="#">Como funciona</a>
          </div>
          <div class="footer-section">
            <h4>Plataforma</h4>
            <a href="#">Como funciona</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>Glittr 2025. Todos os direitos reservados.</p>
        <p>Feito com 💖 pela Halcyon & CO</p>
      </div>
    </footer>
  </div>

  <GlitterBackground /> 
</template>

<script>
import HeaderSection from "./HeaderSection.vue";
import MarqueeSlider from "./MarqueeSliderComponent.vue";

export default {
  components: {
    HeaderSection,
    MarqueeSlider,
  }
};

</script>

<style scoped>
* {
  font-family: Poppins;
}

.landing-page {
  width: 100vw;
  margin: 0 auto;
  font-family: "Inter", sans-serif;
}

.hero {
  padding: 8rem 2rem 4rem;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
  background: radial-gradient(
    227.2% 227.14% at 50% -195.88%,
    #ed008c 0%,
    #141414 100%
  );
  display: flex;
  width: 1980px;
  height: 947px;
  padding: 72px 120px;
  gap: 80px;
}

.badge {
  display: flex;
  padding: 5px 10px;
  align-items: center;
  gap: 15px;
  border-radius: 20px;
  border: 1px solid var(--Roxo-Shockkk, #9400ef);
  background: rgba(225, 12, 255, 0.5);
  font-family: Poppins;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  color: #fff;
  width: fit-content;

  p {
    margin: 0;
  }
}

.p tag {
  display: inline-block;
  padding: 0.5rem 1rem;
  background: rgba(255, 0, 255, 0.1);
  border-radius: 20px;
  color: #ff00ff;
  font-size: 0.875rem;
  margin-bottom: 1rem;
}

h1 {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  background: linear-gradient(45deg, #ff00ff, #00ffff);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

p {
  color: var(--Brancoh, #fff);
  font-family: Poppins;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 150%;
  /* 27px */
}

.primary-button {
  display: flex;
  width: 209px;
  height: 44px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 10px;
  background: linear-gradient(90deg, #ed008c 0%, #9400ef 100%);
  border: none;
  font-weight: 600;
  font-size: 16px;
  color: #fff;
  border-radius: 30px;
}

.secondary-button {
  display: flex;
  width: 209px;
  height: 44px;
  padding: 15px 20px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 10px;
  background: var(--Brancoh, #fff);
  color: var(--Roxo-Shockkk, #9400ef);
  text-align: center;
  font-family: Poppins;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
}

.subtitle {
  color: var(--Cinza-Escuro, #757575);
  font-family: Poppins;
  font-size: 24px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

.features {
  padding: 4rem 2rem;
  background: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.feature-cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  width: fit-content;
  margin: 0 auto;
  /* Isso centraliza horizontalmente */
}

.feature-card {
  display: flex;
  width: 405px;
  height: 200px;
  padding: 20px;
  display: flex;
  gap: 30px;
  flex-direction: column;
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  justify-content: start;

  p {
    color: #141414;
  }
}

.how-it-works {
  display: flex;
  padding: 100px 0px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 60px;
  align-self: stretch;
  background: #f9fafb;
  padding: 4rem 2rem;
  text-align: center;
}

.steps {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  margin-top: 3rem;
}

.highlight {
  color: #ff00ff;
  background: var(--Preto, linear-gradient(90deg, #9400ef 0%, #ff648c 100%));
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-family: Poppins;
  font-size: 42px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}

.newsletter {
  display: flex;
  width: 1980px;
  height: 445px;
  padding: 0px 21px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 10px;
  background: #1f1f1f;
}

.footer {
  display: flex;
  padding: 100px 250px;
  flex-direction: column;
  align-items: flex-start;
  gap: 60px;
  align-self: stretch;
  background: var(--Preto, #141414);
}

.footer-content {
  display: grid;
  grid-template-columns: 1fr 2fr 1fr;
  gap: 4rem;
  margin-bottom: 2rem;
}

@media (max-width: 768px) {
  .hero {
    grid-template-columns: 1fr;
    text-align: center;
  }

  .feature-cards,
  .steps {
    grid-template-columns: 1fr;
  }

  .footer-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
}

#logo {
  display: flex;
  width: 15px;
  height: 15px;
  justify-content: center;
  align-items: center;
}

.cta-buttons {
  display: inline-flex;
  flex-direction: row;
  gap: 24px;
}

h2 {
  color: var(--Preto, #141414);
  text-align: center;
  font-family: Poppins;
  font-size: 42px;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.highlight-pink {
  color: #ed008c;
  font-family: Poppins;
  font-size: 42px;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.step {
  max-width: 350px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;

  h3 {
    font-size: 20px;
    font-style: normal;
    color: #141414;
  }

  p {
    font-size: 16px;
    color: #757575;
  }
}

.step-icon:hover {
  border-radius: 100px;
  background: var(--Rosa-Shockkk, #ed008c);

  box-shadow: 0px 4px 10px 0px #ed008c;
}

.cta-section {
  background: var(--Rosa-Dark, #b33974);
  display: flex;
  height: 746px;
  padding: 10px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 10px;
  align-self: stretch;
}

.cta-card {
  display: flex;
  width: 1536px;
  height: 530px;
  padding-left: 60px;
  justify-content: space-between;
  align-items: center;
  flex-shrink: 0;
  border-radius: 20px;
  background: var(--Brancoh, #fff);
  box-shadow: 0px 3px 40px 0px rgba(225, 12, 255, 0.75);
  overflow: hidden;
}

.text-section {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 30px;
}

.CTA-Text {
  color: var(--Preto, #141414);
  font-family: Poppins;
  font-size: 64px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  margin: 0;
}

.highlight-cta {
  background: linear-gradient(
    90deg,
    #9400ef 0%,
    #ed008c 50%,
    #e10cff 75%,
    #ff648c 100%
  );
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-family: Poppins;
  font-size: 64px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}

.newsletter-content {
  width: 1070px;
  height: 337px;
  flex-shrink: 0;
  background: url("/src/assets/images/sixpointedbg.svg");
  display: flex;
  justify-content: center;
}

.text-content {
  height: 337px;
  flex-shrink: 0;
  display: inline-flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;

  p {
    font-family: Poppins;
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    margin: 0;
  }
}

.newsletter-form {
  display: flex;
  align-items: center;
  width: 244px;
  height: 44px;
  padding: 0 10px;
  gap: 10px;
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.5);
  background: rgba(255, 255, 255, 0.15);
  box-sizing: border-box;
}

.send-button {
  display: flex;
  width: 140px;
  padding: 10px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 10px;
  border: 1px solid var(--Brancoh, #fff);
  background: var(--Brancoh, #fff);
  color: var(--Fuksiah, #e10cff);
  font-size: 16px;
  font-weight: 400;
  height: 44px;
}

.newsletter-form input {
  flex: 1;
  height: 100%;
  background: transparent;
  border: none;
  outline: none;
  color: white;
  font-size: 14px;
  font-family: inherit;
  padding: 0 4px;
}

.newsletter-form input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

small {
  color: var(--Brancoh, #fff);
  text-align: center;
  font-size: 15px;
  font-weight: 400;
}

.footer-bottom {
  display: inline-flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  text-align: center;
}

.footer-links {
  display: flex;
  width: 1017px;
  align-items: flex-start;
  gap: 120px;
}

h4 {
  color: #fff;
}

a {
  color: #fff;
}

.brand-name {
  color: var(--Rosa-Shockkk, #ed008c);
  font-family: Montserrat;
  font-size: 56px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  margin: 0;
  margin-bottom: 15px;
}

.footer-logo {
  display: inline-flex;
  flex-direction: column;
}

.social-links {
  display: flex;
  gap: 30px;
}

.newsletter {
  position: relative;
  background-color: #000;
  overflow: hidden;
}

.newsletter::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  z-index: 0;
  pointer-events: none;

  background-image:
    radial-gradient(12px 2px at 5% 10%, #fff 0%, transparent 100%),
    radial-gradient(1.5px 1.5px at 15% 20%, #ff66cc 0%, transparent 100%),
    radial-gradient(2px 2px at 25% 30%, #ffffffcc 0%, transparent 100%),
    radial-gradient(1.8px 1.8px at 35% 40%, #ff99cc 0%, transparent 100%),
    radial-gradient(1.2px 1.2px at 45% 50%, #fff 0%, transparent 100%),
    radial-gradient(2px 2px at 55% 60%, #ff66cc 0%, transparent 100%),
    radial-gradient(1.4px 1.4px at 65% 70%, #fff 0%, transparent 100%),
    radial-gradient(1.8px 1.8px at 75% 80%, #ff99cc 0%, transparent 100%),
    radial-gradient(2px 2px at 85% 90%, #fff 0%, transparent 100%),
    radial-gradient(9.5px 1.5px at 95% 25%, #ff66cc 0%, transparent 100%);


  animation: sparkle 12s ease-in-out infinite;
  opacity: 1;
}

@keyframes sparkle {
  0% {
    transform: translate(0, 0);
    opacity: 0.9;
  }
  50% {
    transform: translate(10px, 10px);
    opacity: 1;
  }
  100% {
    transform: translate(0, 0);
    opacity: 0.9;
  }
}

.newsletter-content {
  position: relative;
  z-index: 1;
}


</style>
