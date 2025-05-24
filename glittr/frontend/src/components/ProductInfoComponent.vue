<template>
  <main class="main-product">
    <section class="product-title-and-compare-button">
      <h1 class="title-product">{{ product.product.product_name }}</h1>
      <button class="compare-button">
        <img src="@/assets/icons/balance-compare.svg" alt="Comparar produto">
        <span class="button-text-compare">Comparar produto</span>
      </button>
    </section>

    <section class="product-info-title-section">
      <h1 class="product-info-title-section-text">Informações gerais</h1>
    </section>

    <section class="product-image-and-details">
      <div class="product-image-and-details-img">
        <img :src="`http://127.0.0.1:8000${product.product.image_path[0].replace(/^\/storage\//, '')}`"
             alt="Imagem do produto de teste">
      </div>

      <div class="product-image-and-details-details">
        <h2 class="title-details">Marca</h2>
        <p class="details-product"> {{ product.product.brand }}</p>

        <h4 class="title-details">Categoria</h4>
        <p class="details-product"> {{ product.product.category.name }} > {{ product.product.subcategory.name }}</p>

        <h4 class="title-details">Preço médio *</h4>
        <p class="details-product">R$ {{ product.product.price_average }}</p>

        <h4 class="title-details">Tom </h4>
        <p class="details-product">Quantidade de tons</p>

        <h4 class="title-details">Link para compra</h4>
        <h6 class="product-link"><a target="_blank" :href="product.product.product_link">{{
            product.product.product_link
          }}</a></h6>
      </div>
    </section>

    <section class="product-description-details">
      <h4 class="title-details">Descrição</h4>
      <p class="details-product-description">{{ product.product.description }}</p>
    </section>

    <section class="product-physical-characteristics">

      <h1 class="product-info-title-section-text">Ingredientes</h1>

      <div class="product-physical-characteristics-content">

        <div class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details"> Ingredientes </h1>
          <p class="details-product">{{ product.product.ingredients }}</p>
        </div>

      </div>

    </section>

    <section class="product-physical-characteristics">

      <h1 class="product-info-title-section-text">Caracterísiticas do produto</h1>

      <div v-if="product.product.attributes" class="product-physical-characteristics-content">
        <div v-for="(attr, index) in product.product.attributes" :key="index"
             class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details">{{ attr.name }}</h1>
          <p class="details-product"
             :class="typeof attr.value === 'boolean' ? (attr.value ? 'boolean-true' : 'boolean-false') : ''">
            {{ formatAttributeValue(attr.value) }}
          </p>
        </div>
      </div>

    </section>

    <section class="product-details-feedback">

      <div class="toggle-and-title-feedback">
        <h1 class="toggle-title-feedback">Opiniões</h1>
        <span class="toggle-icon-feedback">
          <img src="@/assets/icons/arrow-up.svg" alt="Icone indicando seta pra cima">
        </span>
      </div>

      <div class="product-feedback-add">

        <button class="product-feedback-button-add">
          <img src="@/assets/icons/icon-conversation.svg" class="product-feedback-button-icon" alt="Icone de conversa">
          <span class="product-feedback-button-text">Adicionar avaliação</span>
        </button>
      </div>

    </section>

    <section class="product-details-feedbacks">

      <FeedbackComponent/>
      <FeedbackComponent/>

    </section>
  </main>
</template>

<script>
import FeedbackComponent from "@/components/FeedbackComponent.vue";

export default {
  name: 'ProductInfoComponent',
  components: {
    FeedbackComponent: FeedbackComponent,
  },
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
  methods: {
    formatAttributeValue(value) {
      if (typeof value === 'boolean') {
        return value ? 'Sim' : 'Não';
      }
      return value;
    }
  },
};
</script>

<style scoped>
.main-product {
  display: flex;
  flex-direction: column;
  gap: 30px;
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.title-product {
  color: #141414;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px;
}

.compare-button {
  display: flex;
  padding: 10px;
  align-items: center;
  gap: 20px;
  border-radius: 10px;
  background: linear-gradient(90deg, #E10CFF 0%, #ED008C 100%);
}

.button-text-compare {
  color: #FFF;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 20px;
}

.product-title-and-compare-button {
  display: flex;
  justify-content: space-between;
  align-items: center;
  align-self: stretch;
}

.product-info-title-section {
  align-self: stretch;
}

.product-info-title-section-text {
  margin-bottom: -10px;
  color: #CACACA;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px;
}

.product-image-and-details {
  display: flex;
  align-items: flex-start;
  gap: 30px;
  align-self: stretch;
}

.product-image-and-details-img {
  width: 400px;
  height: 400px;
  flex-shrink: 0;
  border: #CACACA 1px solid;
  border-radius: 5px;

  display: flex;
  justify-content: center;
  align-items: center;
}

.product-image-and-details-img img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.product-image-and-details-details {
  display: flex;
  height: 310px;
  flex-direction: column;
  justify-content: space-between;
  align-items: flex-start;
}

.title-details {
  color: #ED008C;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px;
  margin-bottom: -10px;
}

.details-product {
  color: #141414;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px;
}

.details-product-description {
  color: #141414;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px;
}

.product-description-details {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 5px;
  align-self: stretch;
}

product-physical-characteristics {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 15px;
  align-self: stretch;
  margin-top: 30px;
  width: 100%;
}

.product-physical-characteristics-content {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  width: 100%;
  align-items: flex-start;
}

.product-physical-characteristics-content-characteristics {
  display: flex;
  flex-direction: column;
  min-width: 120px;
  padding: 12px 15px;
  background: #FFF;
  border-radius: 8px;
  border: 1px solid #F0F0F0;
  gap: 4px;
  flex-grow: 1;
  margin-top: 20px;
  max-width: 100%;
}

.product-details-feedback {
  border-top: 1px solid #D9D9D9;
  display: flex;
  padding: 30px 30px 15px 30px;
  flex-direction: column;
  align-items: flex-start;
  gap: 30px;
  align-self: stretch;
}

.toggle-and-title-feedback {
  display: flex;
  justify-content: space-between;
  align-items: center;
  align-self: stretch;
}

.toggle-title-feedback {
  color: #141414;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%;
}

.product-feedback-add {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  gap: 10px;
  align-self: stretch;
}


.toggle-icon-feedback {
  width: 24px;
  height: 24px;
  aspect-ratio: 1/1;
}


.product-feedback-button-add {
  display: flex;
  padding: 10px;
  align-items: center;
  gap: 15px;
  border-radius: 10px;
  background: linear-gradient(90deg, #ED008C 0%, rgba(244, 72, 156, 0.50) 50%, #FA90AB 100%);
}

.product-feedback-button-text {
  color: #FFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}

.product-feedback-button-icon {
  width: 24px;
  height: 24px;
  aspect-ratio: 1/1;
}

.product-link {
  color: #ED008C;
  text-align: left;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px;
}

.boolean-true {
  color: #10B981 !important;
}

.boolean-false {
  color: #EF4444 !important;
}

.product-physical-characteristics-content-characteristics:hover, .compare-button:hover, .product-feedback-button-add:hover {
  border: 1px solid #ED008C;
  transition: border-color 0.5s ease;
}

@media (max-width: 768px) {
  .product-physical-characteristics-content {
    gap: 12px;
  }

  .product-physical-characteristics-content-characteristics {
    min-width: calc(50% - 10px);
    max-width: calc(50% - 10px);
  }
}
</style>
