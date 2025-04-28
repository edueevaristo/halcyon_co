<template>
  <div class="landing-page">
    <header class="header">
      <HeaderSectionComponent/>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <div class="badge">
          <img src="@/assets/icons/LogoGlittr.svg" alt="Logo da Glittr. Uma estrela rosa." id="logo">
          <p>Faça parte da nossa comunidade brilhante ✨</p>
        </div>
        <h1>Compare. Descubra.
          <shine>Brilhe.</shine>
        </h1>
        <p>O Glittr te ajuda a encontrar os melhores produtos de beleza com comparações reais e avaliações honestas.</p>
        <div class="cta-buttons">
          <button class="primary-button">Começar agora<img src="@/assets/icons/chevron-right.svg" alt=""></button>
          <button class="secondary-button">Como funciona</button>
        </div>
      </div>
      <div class="hero-image">
        <!-- Placeholder para a imagem principal -->
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
    <section class="how-it-works">
      <h2>Como <span class="highlight">funciona?</span></h2>
      <p class="subtitle">Encontrar os seus matches de beleza nunca foi tão fácil.</p>

      <div class="steps">

        <div class="step">
          <div class="step-icon search"><img src="@/assets/icons/search.svg" alt=""></div>
          <h3>Busque cosméticos</h3>
          <p>Procure seus produtos de beleza favoritos</p>
        </div>


        <div class="step">
          <div class="step-icon compare"><img src="@/assets/icons/compare.svg" alt=""></div>
          <h3>Compare até 2 produtos</h3>
          <p>Veja comparações lado a lado para tomar a melhor decisão</p>
        </div>
        <div class="step">
          <div class="step-icon choose"><img src="@/assets/icons/buy.svg" alt=""></div>
          <h3>Faça escolhas melhores</h3>
          <p>Escolha produtos que realmente combinam com você</p>
        </div>
        <div class="step">
          <div class="step-icon share"><img src="@/assets/icons/like.svg" alt=""></div>
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
            <img src="@/assets/icons/LogoGlittr.svg" alt="" id="logo">
            Faça parte da nossa comunidade brilhante ✨
          </div>
          <p class="CTA-Text">pront@ pra dar seu <span class="highlight-cta">beauty match?</span></p>
          <p style="color: #141414;">Junte-se a uma comunidade incrível de beauty lovers online! 💄</p>
          <router-link to="/presentation" class="primary-button">
            <div v-html="loginIcon"></div>
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
    <section class="newsletter">
      <div class="newsletter-content">
        <h2>Brilhe mais com o Glittr ✨</h2>
        <p>Mantenha-se por dentro das novidades exclusivas de beauty & tech do universo do Glittr!</p>
        <div class="newsletter-form">
          <input type="email" placeholder="Digite seu e-mail"/>
          <button class="primary-button">Enviar</button>
        </div>
        <small>Não enviamos spam, prometemos! ✨</small>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="footer-content">
        <div class="footer-logo">
          <img src="@/assets/icons/LogoGlittr.svg" alt="Glittr"/>
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
        <div class="social-links">
          <a href="#" class="social-icon youtube"></a>
          <a href="#" class="social-icon instagram"></a>
          <a href="#" class="social-icon twitter"></a>
        </div>
      </div>
      <div class="footer-bottom">
        <p>Glittr 2023. Todos os direitos reservados.</p>
        <p>Feito com 💖 pela Halcyon & CO</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import HeaderSectionComponent from '../components/HeaderSectionComponent.vue';
import MarqueeSlider from '../components/MarqueeSliderComponent.vue';


</script>

<style scoped>
.landing-page {
  width: 100vw;
  margin: 0 auto;
  font-family: 'Inter', sans-serif;
}


.hero {
  grid-template-columns: 1fr 1fr;
  align-items: center;
  background: radial-gradient(227.2% 227.14% at 50% -195.88%, #ED008C 0%, #141414 100%);
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
  border: 1px solid #9400EF;
  background: rgba(225, 12, 255, 0.50);
  font-family: 'Poppins', sans-serif;
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
  color: #FFF;
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 150%;
}


.primary-button {
  display: flex;
  width: 209px;
  height: 44px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  background: linear-gradient(90deg, #ED008C 0%, #9400EF 100%);
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
  background: #FFF;
  color: #9400EF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
}

.subtitle {
  color: #757575;
  font-family: 'Poppins', sans-serif;
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
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 60px;
  align-self: stretch;
  background: #F9FAFB;
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
  background: linear-gradient(90deg, #9400EF 0%, #FF648C 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-family: 'Poppins', sans-serif;
  font-size: 42px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}

.newsletter {
  background: linear-gradient(45deg, #ff00ff22, #00ffff22);
  padding: 4rem 2rem;
  text-align: center;
  border-radius: 1rem;
  margin: 4rem 2rem;
}

.footer {
  background: #1a1a1a;
  color: white;
  padding: 4rem 2rem 2rem;
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
  color: #141414;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 42px;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.highlight-pink {
  color: #ED008C;
  font-family: 'Poppins', sans-serif;
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
  background: #ED008C;

  box-shadow: 0 4px 10px 0 #ED008C;

}

.cta-section {
  background: #B33974;
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
  background: #FFF;
  box-shadow: 0 3px 40px 0 rgba(225, 12, 255, 0.75);
  overflow: hidden;
}

.text-section {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 30px;
}


.CTA-Text {
  color: #141414;
  font-family: 'Poppins', sans-serif;
  font-size: 64px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  margin: 0;
}

.highlight-cta {
  background: linear-gradient(90deg, #9400EF 0%, #ED008C 50%, #E10CFF 75%, #FF648C 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-family: 'Poppins', sans-serif;
  font-size: 64px;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}
</style>