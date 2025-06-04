<template>
  <RouterLink :to="`/product/${id}`">
    <article class="product-card">
      <img :src="imageUrl" alt="Imagem do produto" class="product-image"/>
      <div class="product-content">
        <h3 class="product-title">{{ title }}</h3>
        <button class="compare-button" @click.stop.prevent="openCompareModal">
          <div v-html="compareIcon"></div>
          <span class="button-text">Comparar produto</span>
        </button>
      </div>
    </article>
  </RouterLink>

</template>

<script>
import {useCompareStore} from '../stores/useCompareStore'

export default {
  name: "ProductCard",
  props: {
    id: {
      type: Number,
      required: true
    },
    imageUrl: {
      type: String,
    },
    title: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      compareIcon: `<svg id="112:697" layer-name="SVG" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]">
                      <path d="M11.166 10.6667L13.166 5.33334L15.166 10.6667C14.586 11.1 13.886 11.3333 13.166 11.3333C12.446 11.3333 11.746 11.1 11.166 10.6667Z" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M1.83398 10.6667L3.83398 5.33334L5.83398 10.6667C5.25398 11.1 4.55398 11.3333 3.83398 11.3333C3.11398 11.3333 2.41398 11.1 1.83398 10.6667Z" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M5.16602 14H11.8327" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M8.5 2V14" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M2.5 4.66668H3.83333C5.16667 4.66668 7.16667 4.00001 8.5 3.33334C9.83333 4.00001 11.8333 4.66668 13.1667 4.66668H14.5" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>`
    };
  },
  methods: {
    openCompareModal() {
      const store = useCompareStore()
      store.openModal(this.id)
    }
  },
}
</script>

<style scoped>
.product-card {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-radius: 16px;
  border-width: 1px;
  border-color: rgba(250, 144, 171, 0.2);
  background-color: #fff;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
  0 2px 4px -2px rgba(0, 0, 0, 0.1);
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
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 28px;
  margin: 0;
}

.compare-button-div {
  margin-top: auto;
}

.compare-button {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  width: 100%;
  padding: 8px 16px;
  border-radius: 14px;
  background: linear-gradient(90deg, #9400EF 0%, #E10CFF 100%);
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.10),
  0 2px 4px -2px rgba(0, 0, 0, 0.10);
  border: none;
  cursor: pointer;
}

.button-text {
  color: #fff;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
}


.product-card:hover {
  box-shadow: 0 4px 35px 0 rgba(250, 144, 171, 0.5);
  cursor: pointer;
}

.product-card:hover .product-title {
  color: #ED008C;
}
</style>
