<template>
  <main class="main-product">
    <section class="product-title-and-compare-button">
      <h1 class="title-product">Nome do produto</h1>
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
        <img src="@/assets/images/product-test.png" alt="Imagem do produto de teste">
      </div>

      <div class="product-image-and-details-details">
        <h2 class="title-details">Marca</h2>
        <p class="details-product">Nome da marca</p>

        <h4 class="title-details">Categoria</h4>
        <p class="details-product">Categoria</p>

        <h4 class="title-details">Preço médio *</h4>
        <p class="details-product">Preço médio</p>

        <h4 class="title-details">Tom </h4>
        <p class="details-product">Quantidade de tons</p>

        <h4 class="title-details">Link para compra</h4>
        <p class="details-product">Preço médio</p>
      </div>
    </section>

    <section class="product-description-details">
      <h4 class="title-details">Descrição</h4>
      <p class="details-product-description">Eu peço respeito com a minha família. Com a minhas Maria, com a minha
        Virgínia. Ela sempre no corre, trampando a mil. Sempre apanhando, mas nunca caiu.</p>
    </section>

    <section class="product-physical-characteristics">

      <h1 class="product-info-title-section-text">Caracterísiticas físicas</h1>

      <div class="product-physical-characteristics-content">
        <div class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details">Tipo de pele</h1>
          <p class="details-product">Tipo de pele</p>
        </div>

        <div class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details">Acabamento</h1>
          <p class="details-product">Acabamento</p>
        </div>

        <div class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details">Cobertura</h1>
          <p class="details-product">Cobertura</p>
        </div>

        <div class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details">Textura</h1>
          <p class="details-product">Textura</p>
        </div>

        <div class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details">FPS</h1>
          <p class="details-product">120</p>
        </div>

        <div class="product-physical-characteristics-content-characteristics">
          <h1 class="title-details">Oil-free</h1>
          <p class="details-product">Sim/Não</p>
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

        <FeedbackComponent />
        <FeedbackComponent />

    </section>
  </main>
</template>

<script>
import FeedbackComponent from "@/components/FeedbackComponent.vue";

export default {
  name: 'ProductInfoComponent',
  components: {FeedbackComponent},
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style scoped>
.main-product {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 30px;
  width: 100%;
  max-width: 1000px;
  margin: 0 auto;
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

.product-physical-characteristics {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 15px;
  align-self: stretch;
}

.product-physical-characteristics-content {
  display: flex;
  width: 100%;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap;
}

.product-physical-characteristics-content-characteristics {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 5px;
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
</style>
