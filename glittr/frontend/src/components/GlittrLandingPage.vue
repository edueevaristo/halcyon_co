<template>
  <div class="landing-page">
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

    <main class="main-content">
      <section class="hero-section">
        <div class="badge">
          <div v-html="starIcon"></div>
          <p class="badge-text">Descubra. Compare. Brilhe.</p>
        </div>

        <div class="headline">
          <h2 class="headline-text">Compare produtos de beleza com o</h2>
          <h2 class="brand-name">Glittr</h2>
        </div>

        <p class="description">
          Descubra o produto certo pra você. Compare cosméticos, veja avaliações
          reais e encontre o que funciona melhor para você.
        </p>

        <div class="divider">
          <div class="divider-line"></div>
          <div class="feature-badge">
            <div v-html="sparkleIcon"></div>
            <span class="feature-text">Comparador de produtos</span>
          </div>
          <div class="divider-line"></div>
        </div>
      </section>

      <div class="search-container">
        <div v-html="searchIcon"></div>
        <input
          type="text"
          placeholder="O que você quer comparar hoje?"
          class="search-input"
        />
      </div>

      <div class="category-filters">
        <button class="category-button active">Todas as categorias</button>
        <button class="category-button">🧴 Pele / Skincare</button>
        <button class="category-button">🧖‍♀️ Cabelos</button>
        <button class="category-button">💅 Unhas</button>
        <button class="category-button">🌸 Fragrâncias</button>
        <button class="category-button">🧔 Cuidados Masculinos</button>
        <button class="category-button">💄 Maquiagem</button>
        <button class="category-button">🚿 Corpo e Banho</button>
      </div>

      <section class="product-grid">
        <article class="product-card">
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/1c87f2d0143f3f38e2659cb04530d8648daecaef"
            alt="Hidratante Facial Glow Up"
            class="product-image"
          />
          <div class="product-content">
            <h3 class="product-title">Hidratante Facial Glow Up</h3>
            <button class="compare-button">
              <div v-html="compareIcon"></div>
              <span class="button-text">Comparar produto</span>
            </button>
          </div>
        </article>
      </section>
    </main>
  </div>
</template>

<script>
export default {
  name: "GlittrLandingPage",
  data() {
    return {
      loginIcon: `<svg id="112:807" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]">
<path d="M10 2H12.6667C13.0203 2 13.3594 2.14048 13.6095 2.39052C13.8595 2.64057 14 2.97971 14 3.33333V12.6667C14 13.0203 13.8595 13.3594 13.6095 13.6095C13.3594 13.8595 13.0203 14 12.6667 14H10" stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M6.66602 11.3333L9.99935 7.99996L6.66602 4.66663" stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M10 8H2" stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
      starIcon: `<svg id="112:660" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[14px] h-[14px]">
<path d="M7.00078 2.75L8.28178 5.41L11.2008 5.865L9.10078 7.895L9.63278 10.8L7.00078 9.4L4.36878 10.8L4.90078 7.895L2.80078 5.865L5.71978 5.41L7.00078 2.75Z" fill="white" stroke="white" stroke-width="2"></path>
</svg>`,
      sparkleIcon: `<svg id="112:680" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]">
<path d="M6.6243 10.3334C6.56478 10.1026 6.44453 9.89209 6.27605 9.72361C6.10757 9.55513 5.89702 9.43488 5.6663 9.37536L1.5763 8.32069C1.50652 8.30088 1.44511 8.25886 1.40138 8.20099C1.35765 8.14312 1.33398 8.07256 1.33398 8.00002C1.33398 7.92749 1.35765 7.85693 1.40138 7.79906C1.44511 7.74119 1.50652 7.69916 1.5763 7.67936L5.6663 6.62402C5.89693 6.56456 6.10743 6.44441 6.2759 6.27605C6.44438 6.10769 6.56468 5.89728 6.6243 5.66669L7.67897 1.57669C7.69857 1.50664 7.74056 1.44492 7.79851 1.40095C7.85647 1.35699 7.92722 1.33319 7.99997 1.33319C8.07271 1.33319 8.14346 1.35699 8.20142 1.40095C8.25938 1.44492 8.30136 1.50664 8.32097 1.57669L9.37497 5.66669C9.43449 5.8974 9.55474 6.10795 9.72322 6.27644C9.8917 6.44492 10.1023 6.56517 10.333 6.62469L14.423 7.67869C14.4933 7.69809 14.5553 7.74003 14.5995 7.79807C14.6437 7.85612 14.6677 7.92706 14.6677 8.00002C14.6677 8.07298 14.6437 8.14393 14.5995 8.20197C14.5553 8.26002 14.4933 8.30196 14.423 8.32136L10.333 9.37536C10.1023 9.43488 9.8917 9.55513 9.72322 9.72361C9.55474 9.89209 9.43449 10.1026 9.37497 10.3334L8.3203 14.4234C8.3007 14.4934 8.25871 14.5551 8.20075 14.5991C8.1428 14.6431 8.07205 14.6669 7.9993 14.6669C7.92656 14.6669 7.85581 14.6431 7.79785 14.5991C7.73989 14.5551 7.69791 14.4934 7.6783 14.4234L6.6243 10.3334Z" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M13.334 2V4.66667" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M14.6667 3.33331H12" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M2.66602 11.3333V12.6666" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M3.33333 12H2" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
      searchIcon: `<svg id="112:689" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[24px] h-[24px]">
<path d="M20.1 21L13.8 14.7C13.3 15.1 12.725 15.4167 12.075 15.65C11.425 15.8833 10.7333 16 10 16C8.18333 16 6.646 15.3707 5.388 14.112C4.13 12.8533 3.50067 11.316 3.5 9.5C3.49933 7.684 4.12867 6.14667 5.388 4.888C6.64733 3.62933 8.18467 3 10 3C11.8153 3 13.353 3.62933 14.613 4.888C15.873 6.14667 16.502 7.684 16.5 9.5C16.5 10.2333 16.3833 10.925 16.15 11.575C15.9167 12.225 15.6 12.8 15.2 13.3L21.5 19.6L20.1 21ZM10 14C11.25 14 12.3127 13.5627 13.188 12.688C14.0633 11.8133 14.5007 10.7507 14.5 9.5C14.4993 8.24933 14.062 7.187 13.188 6.313C12.314 5.439 11.2513 5.00133 10 5C8.74867 4.99867 7.68633 5.43633 6.813 6.313C5.93967 7.18967 5.502 8.252 5.5 9.5C5.498 10.748 5.93567 11.8107 6.813 12.688C7.69033 13.5653 8.75267 14.0027 10 14Z" fill="#B33974"></path>
</svg>`,
      compareIcon: `<svg id="112:697" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]">
<path d="M11.166 10.6667L13.166 5.33334L15.166 10.6667C14.586 11.1 13.886 11.3333 13.166 11.3333C12.446 11.3333 11.746 11.1 11.166 10.6667Z" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M1.83398 10.6667L3.83398 5.33334L5.83398 10.6667C5.25398 11.1 4.55398 11.3333 3.83398 11.3333C3.11398 11.3333 2.41398 11.1 1.83398 10.6667Z" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M5.16602 14H11.8327" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M8.5 2V14" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M2.5 4.66668H3.83333C5.16667 4.66668 7.16667 4.00001 8.5 3.33334C9.83333 4.00001 11.8333 4.66668 13.1667 4.66668H14.5" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
    };
  },
};
</script>

<style scoped>
.landing-page {
  display: flex;
  flex-direction: column;
  min-height: screen;
  background-color: #fff;
}

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

.main-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-left: 20px;
  padding-right: 20px;
  padding-top: 40px;
  padding-bottom: 40px;
  gap: 37px;
  max-width: 1248px;
  margin-left: auto;
  margin-right: auto;
}

.hero-section {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 24px;
  width: 100%;
}

.badge {
  display: flex;
  padding: 4px 16px;
  align-items: center;
  gap: 10px;
  border-radius: 9999px;
  background-color: #ed008c;
}

.badge-text {
  color: #fff;
  text-align: center;
  font-family: Poppins;
  font-size: 14px;
  font-weight: 500;
  line-height: 20px;
  margin: 0;
}

.headline {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  text-align: center;
}

@media (max-width: 640px) {
  .headline {
    flex-direction: column;
  }
}

.headline-text {
  color: #141414;
  font-family: Poppins;
  font-size: 36px;
  font-weight: 700;
  line-height: 40px;
  margin: 0;
}

@media (max-width: 640px) {
  .headline-text {
    font-size: 28px;
  }
}

.brand-name {
  text-align: center;
  font-family: Montserrat;
  font-size: 36px;
  font-weight: 700;
  line-height: 40px;
  background-color: clip-text;
  --tw-gradient-from: [#9400EF];
  --tw-gradient-stops: rgba(255, 255, 255, 0);
  --tw-gradient-to: [#ED008C];
  margin: 0;
}

@media (max-width: 640px) {
  .brand-name {
    font-size: 28px;
  }
}

.description {
  color: #4b5563;
  text-align: center;
  font-family: Poppins;
  font-size: 16px;
  line-height: 24px;
  max-width: 800px;
  margin: 0;
}

.divider {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2px;
  width: 100%;
}

.divider-line {
  width: 528.8px;
  height: 1px;
  background-color: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(148, 0, 239, 0.3) 50%,
    rgba(0, 0, 0, 0) 100%
  );
}

.feature-badge {
  display: flex;
  padding: 6px 16px;
  justify-content: center;
  align-items: center;
  gap: 8px;
  border-radius: 9999px;
  background-color: #fa90ab;
}

.feature-text {
  color: #fff;
  font-family: Poppins;
  font-size: 14px;
  font-weight: 500;
  line-height: 20px;
}

.search-container {
  display: flex;
  width: 100%;
  max-width: 963px;
  padding: 16px 30px;
  align-items: center;
  gap: 10px;
  border-radius: 30px;
  border-width: 1px;
  border-color: #9400ef;
}

.search-input {
  flex: 1;
  color: #757575;
  font-family: Poppins;
  font-size: 16px;
  line-height: 150%;
  border: none;
  outline: none;
  background: transparent;
}

.category-filters {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
  width: 100%;
  max-width: 1248px;
}

.category-button {
  font-family: Poppins;
  font-size: 14px;
  font-weight: 500;
  padding: 5px 10px;
  border-radius: 30px;
  border-width: 1px;
  border-color: #757575;
  background-color: #fff;
  color: #757575;
  cursor: pointer;
}

.category-button.active {
  color: #fff;
  background-color: #141414;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 24px;
  width: 100%;
  max-width: 1248px;
}

@media (max-width: 991px) {
  .product-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 640px) {
  .product-grid {
    grid-template-columns: repeat(1, minmax(0, 1fr));
  }
}

.product-card {
  display: flex;
  flex-direction: column;
  border-radius: 16px;
  border-width: 1px;
  border-color: rgba(250, 144, 171, 0.2);
  background-color: #fff;
  box-shadow:
    0px 4px 6px -1px rgba(0, 0, 0, 0.1),
    0px 2px 4px -2px rgba(0, 0, 0, 0.1);
}

.product-image {
  width: 100%;
  height: 256px;
  object-fit: cover;
  border-top-left-radius: 16px;
  border-top-right-radius: 16px;
}

.product-content {
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.product-title {
  color: #141414;
  font-family: Poppins;
  font-size: 18px;
  font-weight: 500;
  line-height: 28px;
  margin: 0;
}

.compare-button {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  width: 100%;
  padding: 8px 16px;
  border-radius: 14px;
  background: linear-gradient(to right, #9400ef, #e10cff);
  box-shadow:
    0px 4px 6px -1px rgba(0, 0, 0, 0.1),
    0px 2px 4px -2px rgba(0, 0, 0, 0.1);
  border: none;
  cursor: pointer;
}

.button-text {
  color: #fff;
  text-align: center;
  font-family: Poppins;
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
}
</style>
