<template>
  <div class="marquee-wrapper">
    <div class="marquee-content">
      <div v-for="(text, index) in texts" :key="index" class="marquee-item">
        {{ text }}
      </div>
      <div v-for="(text, index) in texts" :key="'dup-' + index" class="marquee-item">
        {{ text }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MarqueeSliderComponent',
  data() {
    return {
      texts: [
        '💗 Encontre comparações reais e honestas de produtos',
        '💄 Compare lado a lado e tome decisões certeiras',
        '💰 Descubra o que vale a pena antes de gastar seu dinheiro',
      ]
    }
  }
}
</script>

<style scoped>
.marquee-wrapper {
  overflow: hidden;
  width: 100%;
  height: 50px;
  display: flex;
  align-items: center;
  background-color: #1a1a1a;
}

.marquee-content {
  display: flex;
  width: max-content;
  animation: scroll-left 30s linear infinite;
}

.marquee-item {
  white-space: nowrap;
  padding: 0 40px;
  color: #f5f5f5;
  font-size: 1rem;
  font-weight: 600;
}

@keyframes scroll-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}
</style>
