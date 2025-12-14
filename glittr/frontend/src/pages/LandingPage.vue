<template>
  <div class="landing-page">
    <header class="header">
      <HeaderSectionComponent/>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-video-bg">
        <video autoplay muted loop playsinline>
          <source src="@/assets/videos/wave-pink.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
      </div>

      <div class="hero-content">
        <div class="badge">
          <img src="@/assets/icons/LogoGlittr.svg" alt="Logo da Glittr. Uma estrela rosa." id="logo">
          <p>Faça parte da nossa comunidade brilhante ✨</p>
        </div>
        <h1 class="hero-title-initial">Compare. Descubra.
          <span class="hero-title-initial-shine">Brilhe.</span>
        </h1>
        <p class="hero-description">O Glittr te ajuda a encontrar os melhores produtos de beleza com comparações reais e<br class="desktop-only"> avaliações autênticas.</p>
        <div class="cta-buttons">
          <router-link to="/presentation" class="primary-button">Começar agora<img src="@/assets/icons/chevron-right.svg" alt=""></router-link>
          <button class="secondary-button" @click="scrollToHowItWorks">Como funciona</button>
        </div>
      </div>
      <div class="hero-image">
        <img src="@/assets/images/img_video.png" alt="Imagem de uma mulher usando o Glittr." class="img-hero" style="display: none">
      </div>
    </section>

    <MarqueeSlider/>

    <!-- Features Section -->
    <section class="features">
      <h2>Compare o que <span class="highlight-pink"> realmente importa </span></h2>
      <div class="feature-cards">
        <div class="feature-card">
          <span class="emoji"><img src="@/assets/icons/solar_heart-bold-duotone.svg" alt=""></span>
          <p>Veja feedbacks reais de outras entusiastas de beauty & glam ✨</p>
        </div>
        <div class="feature-card">
          <span class="emoji"><img src="@/assets/icons/mingcute_love-fill.svg" alt=""></span>
          <p>Compare as características dos produtos para encontrar sua combinação perfeita 💘 </p>
        </div>
        <div class="feature-card">
          <span class="emoji"><img src="@/assets/icons/solar_card-bold.svg" alt=""></span>
          <p>Encontre os produtos com o melhor custo-benefício que se encaixam no seu orçamento 💰</p>
        </div>
      </div>
    </section>

    <!-- Como Funciona Section -->
    <section class="how-it-works" id="how-it-works">
      <h2>Como <span class="highlight">funciona?</span></h2>
      <p class="subtitle">Encontrar os seus matches de beleza nunca foi tão fácil.</p>

      <div class="steps">
        <div class="step">
          <div class="step-icon search"><img src="@/assets/icons/search.svg" alt=""></div>
          <h3>Busque cosméticos</h3>
          <p>Procure pelos produtos de beleza que você tem curiosidade</p>
        </div>
        <div class="step">
          <div class="step-icon compare"><img src="@/assets/icons/compare.svg" alt=""></div>
          <h3>Compare até 2 produtos</h3>
          <p>Veja comparações lado-a-lado das características do produtos</p>
        </div>
        <div class="step">
          <div class="step-icon choose"><img src="@/assets/icons/buy.svg" alt=""></div>
          <h3>Faça escolhas melhores</h3>
          <p>Escolha produtos que dão match com suas preferências e economize ao evitar erros</p>
        </div>
        <div class="step">
          <div class="step-icon share"><img src="@/assets/icons/like.svg" alt=""></div>
          <h3>Influencie & receba conselhos</h3>
          <p>Faça parte da comunidade GLITTR para receber e distribuir feedbacks dos produtos escolhidos.</p>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="cta-card">
        <div class="text-section">
          <div class="badge">
            <img src="@/assets/icons/LogoGlittr.svg" alt="" id="logo">
            Faça parte da nossa comunidade brilhante ✨
          </div>
          <p class="CTA-Text">pront@ pra dar seu <span class="highlight-cta">beauty match?</span></p>
          <p class="cta-description">Junte-se a uma comunidade incrível de beauty lovers online! 💄</p>
          <router-link to="/presentation" class="primary-button">
            <span class="login-text">Começar agora </span>
            <img src="@/assets/icons/chevron-right.svg" alt="Seta pra direita.">
          </router-link>
        </div>

        <div class="img-section">
          <img src="@/assets/images/imgCTA.svg" alt="">
        </div>
      </div>
    </section>

    <!-- Newsletter Section -->
    <div class="newsletter-container">
      <div class="newsletter-video-bg">
        <video autoplay muted loop playsinline>
          <source src="@/assets/videos/newsletter.mp4" type="video/mp4">
        </video>
        <div class="video-overlay-newsletter"></div>
      </div>

      <section class="newsletter">
        <div class="newsletter-content">
          <h2 class="newsletter-title">Brilhe mais com a Glittr <span class="emoji-newsletter">💖</span></h2>
          <p class="newsletter-text">Inscreva-se para receber novidades exclusivas de beauty & tech do universo da Glittr!</p>
          <div class="newsletter-form">
            <input type="email" class="newsletter-input-email" placeholder="Seu melhor e-mail 💌"/>
            <button class="newsletter-button">Inscrever-se</button>
          </div>
          <h6 class="newsletter-disclaimer">Não enviamos spam, prometemos! 💅</h6>
        </div>
      </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <div class="footer-content">
        <div class="logo-and-social">
          <div class="footer-logo">
            <img src="@/assets/icons/LogoGlittrLandingFooter.svg" alt="Glittr"/>
          </div>
          <div class="social-links">
<!--            <a href="#" class="social-icon youtube"><img src="@/assets/icons/youtube.svg" alt="Youtube"></a>-->
            <a href="https://www.instagram.com/app.glittr" target="_blank" class="social-icon instagram"><img src="@/assets/icons/instagram.svg" alt="Instagram"></a>
<!--            <a href="#" class="social-icon twitter"><img src="@/assets/icons/twitter.svg" alt="Twitter"></a>-->
<!--            <a href="#" class="social-icon tiktok"><img src="@/assets/icons/tiktok.svg" alt="Tiktok"></a>-->
          </div>
        </div>

        <div class="footer-links">
          <div class="footer-section">
            <h4 class="text-footer-link"><a href="#">Plataforma</a></h4>
            <h4 class="text-footer-link"><a class="como-funciona-footer" @click="scrollToHowItWorks">Como funciona</a></h4>
          </div>

          <div class="footer-section">
            <h4 class="text-footer-link"><a href="#">A Empresa</a></h4>
            <h4 class="text-footer-link"><a href="#">Fale conosco</a></h4>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p class="text-footer-bottom">Glittr 2025. Todos os direitos reservados.</p>
        <p class="text-footer-bottom-2">Feito com 💖 pela Halcyon & Co</p>
      </div>
    </footer>

    <button
        class="back-to-top"
        :class="{ 'show': mostrarBotaoVoltarTopo }"
        @click="subirAoTopo"
        aria-label="Voltar ao topo"
    >
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20L12 4M12 4L5 11M12 4L19 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import HeaderSectionComponent from '../components/HeaderSectionComponent.vue';
import MarqueeSlider from '../components/MarqueeSliderComponent.vue';

const mostrarBotaoVoltarTopo = ref(false);

const scrollToHowItWorks = () => {

  const howItWorksSection = document.getElementById('how-it-works');

  if (howItWorksSection) {

    howItWorksSection.scrollIntoView({ behavior: 'smooth' });
  }

};

const validarScroll = () => {
  mostrarBotaoVoltarTopo.value = window.scrollY > 300;
};

const subirAoTopo = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
};

onMounted(() => {
  window.addEventListener('scroll', validarScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', validarScroll);
});

</script>

<style scoped>

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.landing-page {
  width: 100%;
  margin: 0 auto;
  font-family: 'Inter', sans-serif;
  overflow-x: hidden;
}

.back-to-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, #ED008C 0%, #9400EF 100%);
  border: none;
  border-radius: 50%;
  color: white;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 20px rgba(237, 0, 140, 0.4);
  transition: all 0.3s ease;
  opacity: 0;
  visibility: hidden;
  transform: translateY(20px);
  z-index: 1000;
}

.back-to-top.show {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.back-to-top:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 25px rgba(237, 0, 140, 0.6);
  background: linear-gradient(135deg, #ff0099 0%, #a300ff 100%);
}

.back-to-top:active {
  transform: translateY(0);
}

.hero {
  position: relative;
  width: 100%;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  overflow: hidden;
}

.hero-video-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.hero-video-bg video {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.video-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(179, 57, 116, 0.30);
}

.hero-content {
  position: relative;
  z-index: 1;
  text-align: center;
  max-width: 800px;
  width: 100%;
}

.hero-image {
  display: none;
}

.badge {
  display: inline-flex;
  padding: 8px 16px;
  align-items: center;
  gap: 10px;
  border-radius: 20px;
  border: 1px solid #9400EF;
  background: rgba(225, 12, 255, 0.50);
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  color: #fff;
  margin-bottom: 30px;
}

.badge p {
  margin: 0;
}

.hero-title-initial {
  color: #FFF;
  text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  font-family: 'Poppins', sans-serif;
  font-size: clamp(2rem, 6vw, 3.5rem);
  font-style: normal;
  font-weight: 700;
  line-height: 1.2;
  letter-spacing: -0.5px;
  margin-bottom: 20px;
}

.hero-title-initial-shine {
  color: #FA90AB;
}

.hero-description {
  color: #FFF;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1rem, 3vw, 1.125rem);
  font-style: normal;
  font-weight: 400;
  line-height: 1.6;
  margin-bottom: 40px;
}

.cta-buttons {
  display: flex;
  gap: 15px;
  justify-content: center;
  flex-wrap: wrap;
}

.primary-button {
  display: inline-flex;
  padding: 12px 24px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  background: linear-gradient(90deg, #ED008C 0%, #9400EF 100%);
  border: none;
  font-weight: 600;
  font-size: 16px;
  color: #fff;
  border-radius: 10px;
  text-decoration: none;
  transition: transform 0.3s ease;
  min-width: 160px;
}

.primary-button:hover {
  transform: translateY(-2px);
}

.secondary-button {
  display: inline-flex;
  padding: 12px 24px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 10px;
  background: #FFF;
  color: #9400EF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  border: none;
  transition: transform 0.3s ease;
  min-width: 160px;
}

.secondary-button:hover {
  transform: translateY(-2px);
}

.features {
  padding: 60px 20px;
  background: #fff;
  text-align: center;
}

.features h2 {
  color: #141414;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.75rem, 5vw, 2.625rem);
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  margin-bottom: 50px;
}

.highlight-pink {
  color: #ED008C;
}

.feature-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.feature-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  background: white;
  padding: 30px 20px;
  border-radius: 1rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.feature-card:hover {
  transform: translateY(-5px);
}

.feature-card p {
  color: #141414;
  font-size: 16px;
  line-height: 1.5;
}

.emoji {
  margin-bottom: 15px;
}

.emoji img {
  width: 50px;
  height: 50px;
}

.how-it-works {
  padding: 60px 20px;
  background: #F9FAFB;
  text-align: center;
}

.how-it-works h2 {
  color: #141414;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.75rem, 5vw, 2.625rem);
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  margin-bottom: 15px;
}

.highlight {
  color: #ff00ff;
  background: linear-gradient(90deg, #9400EF 0%, #FF648C 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.subtitle {
  color: #757575;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1rem, 3vw, 1.5rem);
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  margin-bottom: 50px;
}

.steps {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
  max-width: 1200px;
  margin: 0 auto;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.step h3 {
  font-size: 20px;
  font-style: normal;
  color: #141414;
  margin-bottom: 10px;
}

.step p {
  font-size: 16px;
  color: #757575;
  line-height: 1.5;
}

.step-icon {
  width: 80px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.step-icon:hover {
  background: #ED008C;
  box-shadow: 0 4px 10px 0 #ED008C;
}

.cta-section {
  background: #B33974;
  padding: 60px 20px;
}

.cta-card {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  border-radius: 20px;
  background: #FFF;
  box-shadow: 0 3px 40px 0 rgba(225, 12, 255, 0.75);
  overflow: hidden;
  padding: 40px;
  gap: 40px;
  max-width: 1200px;
  margin: 0 auto;
}

.text-section {
  flex: 1;
  min-width: 300px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  gap: 20px;
}

.CTA-Text {
  color: #141414;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(2rem, 5vw, 4rem);
  font-style: normal;
  font-weight: 700;
  line-height: 1.1;
  margin: 0;
}

.highlight-cta {
  background: linear-gradient(90deg, #9400EF 0%, #ED008C 50%, #E10CFF 75%, #FF648C 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.cta-description {
  color: #141414;
  font-size: 16px;
  line-height: 1.5;
}

.img-section {
  flex: 1;
  min-width: 300px;
  display: flex;
  justify-content: center;
}

.img-section img {
  width: 100%;
  max-width: 400px;
  height: auto;
}

.newsletter-container {
  position: relative;
  width: 100%;
  margin: 0 auto;
  padding: 60px 20px;
}

.newsletter-video-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
}

.newsletter-video-bg video {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.video-overlay-newsletter {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.newsletter {
  position: relative;
  z-index: 1;
  padding: 40px 20px;
  text-align: center;
  margin: 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  border-radius: 20px;
  background: linear-gradient(97deg, #FF648C 0%, #E10CFF 100%);
  max-width: 800px;
}

.newsletter-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  width: 100%;
}

.newsletter-title {
  color: #FFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.5rem, 4vw, 1.875rem);
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  margin-bottom: 10px;
}

.emoji-newsletter {
  color: #FFF;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(1.5rem, 4vw, 1.875rem);
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

.newsletter-text {
  color: #FFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: clamp(0.875rem, 2.5vw, 1rem);
  font-style: normal;
  font-weight: 500;
  line-height: normal;
  max-width: 600px;
}

.newsletter-form {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 10px;
  width: 100%;
  max-width: 500px;
}

.newsletter-input-email {
  flex: 1;
  min-width: 200px;
  padding: 12px 15px;
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.50);
  background: rgba(255, 255, 255, 0.15);
  color: white;
  font-size: 16px;
}

.newsletter-input-email::placeholder {
  color: rgba(255, 255, 255, 0.70);
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

.newsletter-button {
  padding: 12px 24px;
  border-radius: 10px;
  border: 1px solid #FFF;
  background: #FFF;
  color: #E10CFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  cursor: pointer;
  transition: all 0.3s ease;
}

.newsletter-button:hover {
  background: #E10CFF;
  color: #FFF;
}

.newsletter-disclaimer {
  color: #FFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  margin-top: 10px;
}

.footer {
  padding: 60px 20px 30px;
  background: #141414;
}

.footer-content {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: flex-start;
  gap: 40px;
  margin-bottom: 40px;
  max-width: 1200px;
  margin: 0 auto 40px;
}

.logo-and-social {
  display: flex;
  flex-direction: column;
  gap: 30px;
  flex: 1;
  min-width: 250px;
}

.footer-logo img {
  max-width: 150px;
  height: auto;
}

.social-links {
  display: flex;
  align-items: center;
  gap: 15px;
}

.social-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  transition: background 0.3s ease;
}

.social-icon:hover {
  background: rgba(255, 255, 255, 0.2);
}

.footer-links {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  flex: 2;
  justify-content: space-around;
}

.footer-section {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.text-footer-link, .text-footer-link a {
  color: #FFF;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-decoration: none;
  transition: color 0.3s ease;
}

.text-footer-link a:hover {
  color: #ED008C;
}

.footer-bottom {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  padding-top: 30px;
  border-top: 1px solid #757575;
  max-width: 1200px;
  margin: 0 auto;
}

.text-footer-bottom {
  color: #FFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
  margin: 0;
}

.text-footer-bottom-2 {
  color: #FFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
  margin: 0;
}

.como-funciona-footer {
  cursor: pointer;
}

@media (max-width: 1024px) {
  .hero {
    min-height: 80vh;
  }

  .feature-cards {
    grid-template-columns: repeat(2, 1fr);
  }

  .steps {
    grid-template-columns: repeat(2, 1fr);
  }

  .footer-links {
    justify-content: space-between;
  }
}

@media (max-width: 768px) {
  .hero {
    min-height: 70vh;
    padding: 40px 20px;
  }

  .cta-buttons {
    flex-direction: column;
    align-items: center;
  }

  .primary-button, .secondary-button {
    width: 100%;
    max-width: 280px;
  }

  .feature-cards {
    grid-template-columns: 1fr;
  }

  .steps {
    grid-template-columns: 1fr;
  }

  .cta-card {
    padding: 30px 20px;
  }

  .footer-content {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .footer-links {
    justify-content: center;
    gap: 30px;
  }

  .footer-section {
    align-items: center;
  }

  .desktop-only {
    display: none;
  }
}

@media (max-width: 600px) {
  .hero {
    min-height: 60vh;
    padding: 30px 15px;
  }

  .badge {
    font-size: 12px;
    padding: 6px 12px;
  }

  .feature-card {
    padding: 20px 15px;
  }

  .cta-card {
    padding: 20px 15px;
  }

  .newsletter {
    padding: 30px 15px;
  }

  .newsletter-form {
    flex-direction: column;
    width: 100%;
  }

  .newsletter-input-email {
    width: 100%;
  }

  .footer {
    padding: 40px 15px 20px;
  }

  .footer-links {
    flex-direction: column;
    gap: 20px;
  }
}

@media (max-width: 480px) {
  .hero {
    min-height: 50vh;
  }

  .hero-title-initial {
    font-size: 1.75rem;
  }

  .primary-button, .secondary-button {
    padding: 10px 20px;
    font-size: 14px;
  }

  .features, .how-it-works, .cta-section {
    padding: 40px 15px;
  }

  .step-icon {
    width: 60px;
    height: 60px;
  }

  .step-icon img {
    width: 30px;
    height: 30px;
  }

  .footer-content {
    gap: 30px;
  }

  .logo-and-social {
    align-items: center;
  }

  .social-links {
    justify-content: center;
  }
}

@media (max-width: 360px) {
  .hero-title-initial {
    font-size: 1.5rem;
  }

  .hero-description {
    font-size: 0.9rem;
  }

  .feature-cards, .steps {
    grid-template-columns: 1fr;
  }

  .cta-card {
    padding: 15px 10px;
  }

  .CTA-Text {
    font-size: 1.5rem;
  }
}

@media (max-height: 500px) and (orientation: landscape) {
  .hero {
    min-height: 100vh;
    padding: 20px;
  }

  .hero-content {
    padding: 20px 0;
  }
}

@media (min-width: 1600px) {
  .features, .how-it-works, .cta-section, .newsletter-container, .footer {
    padding-left: calc((100vw - 1200px) / 2);
    padding-right: calc((100vw - 1200px) / 2);
  }
}
</style>