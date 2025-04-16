<template>
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
</template>

<script>
export default {
  name: "HeroSection",
  data() {
    return {
      starIcon: `<svg id="112:660" layer-name="Icons" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[14px] h-[14px]">
<path d="M7.00078 2.75L8.28178 5.41L11.2008 5.865L9.10078 7.895L9.63278 10.8L7.00078 9.4L4.36878 10.8L4.90078 7.895L2.80078 5.865L5.71978 5.41L7.00078 2.75Z" fill="white" stroke="white" stroke-width="2"></path>
</svg>`,
      sparkleIcon: `<svg id="112:680" layer-name="SVG" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]">
<path d="M6.6243 10.3334C6.56478 10.1026 6.44453 9.89209 6.27605 9.72361C6.10757 9.55513 5.89702 9.43488 5.6663 9.37536L1.5763 8.32069C1.50652 8.30088 1.44511 8.25886 1.40138 8.20099C1.35765 8.14312 1.33398 8.07256 1.33398 8.00002C1.33398 7.92749 1.35765 7.85693 1.40138 7.79906C1.44511 7.74119 1.50652 7.69916 1.5763 7.67936L5.6663 6.62402C5.89693 6.56456 6.10743 6.44441 6.2759 6.27605C6.44438 6.10769 6.56468 5.89728 6.6243 5.66669L7.67897 1.57669C7.69857 1.50664 7.74056 1.44492 7.79851 1.40095C7.85647 1.35699 7.92722 1.33319 7.99997 1.33319C8.07271 1.33319 8.14346 1.35699 8.20142 1.40095C8.25938 1.44492 8.30136 1.50664 8.32097 1.57669L9.37497 5.66669C9.43449 5.8974 9.55474 6.10795 9.72322 6.27644C9.8917 6.44492 10.1023 6.56517 10.333 6.62469L14.423 7.67869C14.4933 7.69809 14.5553 7.74003 14.5995 7.79807C14.6437 7.85612 14.6677 7.92706 14.6677 8.00002C14.6677 8.07298 14.6437 8.14393 14.5995 8.20197C14.5553 8.26002 14.4933 8.30196 14.423 8.32136L10.333 9.37536C10.1023 9.43488 9.8917 9.55513 9.72322 9.72361C9.55474 9.89209 9.43449 10.1026 9.37497 10.3334L8.3203 14.4234C8.3007 14.4934 8.25871 14.5551 8.20075 14.5991C8.1428 14.6431 8.07205 14.6669 7.9993 14.6669C7.92656 14.6669 7.85581 14.6431 7.79785 14.5991C7.73989 14.5551 7.69791 14.4934 7.6783 14.4234L6.6243 10.3334Z" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M13.334 2V4.66667" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M14.6667 3.33331H12" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M2.66602 11.3333V12.6666" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M3.33333 12H2" stroke="#ED008C" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>`,
    };
  },
};
</script>

<style scoped>
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
  justify-content: center;
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
  background-color: linear-gradient(90deg,
      rgba(0, 0, 0, 0) 0%,
      rgba(148, 0, 239, 0.3) 50%,
      rgba(0, 0, 0, 0) 100%);
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

.brand-name {
  background: linear-gradient(90deg, #9400EF 0%, #ED008C 100%);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-size: 36px;
  font-weight: 800 !important;
}
</style>
