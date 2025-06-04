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
      <div class="toggle-and-title-feedback" @click="toggleFeedbackSection">
        <h1 class="toggle-title-feedback">Opiniões</h1>
        <span class="toggle-icon-feedback">
          <img
              :src="feedbackSectionOpen ? arrowUpIcon : arrowDownIcon"
              alt="Ícone de seta"
              class="arrow-icon"
          >
        </span>
      </div>

      <transition name="slide-fade">
        <div v-if="feedbackSectionOpen" class="feedback-section-content">
          <div class="product-feedback-add">
            <button class="product-feedback-button-add" @click="openModalAvaliation">
              <img src="@/assets/icons/icon-conversation.svg" class="product-feedback-button-icon"
                   alt="Icone de conversa">
              <span class="product-feedback-button-text">Adicionar avaliação</span>
            </button>
          </div>

          <section class="product-details-feedbacks">
            <template v-if="reviews.length > 0">
              <FeedbackComponent
                  v-for="(review, index) in reviews"
                  :key="index"
                  :review="review"
              />
            </template>
            <div v-else class="no-reviews-message">
              <img src="@/assets/icons/icon-conversation.svg" alt="Ícone de comentário" class="comment-icon">
              <p>Nenhum comentário/review adicionado a este produto.</p>
            </div>
          </section>
        </div>
      </transition>
    </section>


    <AvaliationModalComponent ref="avaliationModal" @submit-review="handleSubmitReview"/>
  </main>
</template>

<script>
import {ref} from 'vue';
import FeedbackComponent from "@/components/FeedbackComponent.vue";
import AvaliationModalComponent from "./AvaliationModalComponent.vue";
import PostReviewDataService from "@/services/PostReviewDataService.js";
import {showGlittrModal} from "@/stores/useSweetAlertGlittr.js";
import arrowUpIcon from "@/assets/icons/arrow-up.svg";
import arrowDownIcon from "@/assets/icons/arrow-down.svg";

export default {
  name: 'ProductInfoComponent',
  components: {
    FeedbackComponent: FeedbackComponent,
    AvaliationModalComponent: AvaliationModalComponent,
  },
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      arrowUpIcon,
      arrowDownIcon,
      review: {
        product_id: null,
        comment: '',
        stars: null,
      },
      reviews: [],
      feedbackSectionOpen: true,
      isRotating: false
    };
  },
  mounted() {
    this.review.product_id = this.product.product.id;
    this.fetchReviews();
  },
  setup() {
    const avaliationModal = ref(null);

    const openModalAvaliation = () => {
      if (avaliationModal.value) {
        avaliationModal.value.openModalAvaliation();
      }
    };

    return {
      avaliationModal,
      openModalAvaliation,
    };
  },
  methods: {
    toggleFeedbackSection() {
      this.isRotating = true;
      this.feedbackSectionOpen = !this.feedbackSectionOpen;
    },
    formatAttributeValue(value) {
      if (typeof value === 'boolean') {
        return value ? 'Sim' : 'Não';
      }
      return value;
    },
    submit() {
      this.$emit('submit-review', {...this.localReview});
    },
    async handleSubmitReview(payload) {
      try {
        const dataToSend = {
          ...payload,
          product_id: this.product.product.id,
        };
        await PostReviewDataService.createReview(dataToSend);

        if (this.$refs.avaliationModal && this.$refs.avaliationModal.closeModal) {
          this.$refs.avaliationModal.closeModal();
        }

        showGlittrModal({
          icon: 'success',
          title: 'Avaliação enviada!',
          text: 'Muito obrigado por avaliar nosso produto. Sua opinião é muito importante para nós!',
          confirmButtonText: 'OK'
        });

        await this.fetchReviews();

      } catch (error) {
        console.error(error);
        showGlittrModal({
          icon: 'error',
          title: 'Erro ao enviar avaliação',
          text: error.response?.data?.message || 'Ocorreu um erro ao enviar sua avaliação. Por favor, tente novamente.',
          confirmButtonText: 'Entendi'
        });
      }
    },
    async fetchReviews() {
      try {
        const response = await PostReviewDataService.getAllForProduct(this.product.product.id);
        this.reviews = response.data;
      } catch (error) {
        console.error(error);
      }
    },
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

.product-physical-characteristics {
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
  cursor: pointer;
}

.feedback-section-content {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.product-details-feedbacks {
  display: flex;
  flex-direction: column;
  gap: 20px;
  max-height: 500px;
  overflow-y: auto;
  padding-right: 10px;
  width: 100%;
}

.product-details-feedbacks:empty {
  display: none;
}

.product-details-feedbacks::-webkit-scrollbar {
  width: 6px;
}

.product-details-feedbacks::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.product-details-feedbacks::-webkit-scrollbar-thumb {
  background: #E10CFF;
  border-radius: 10px;
}

.product-details-feedbacks::-webkit-scrollbar-thumb:hover {
  background: #ED008C;
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

.product-physical-characteristics-content-characteristics:hover,
.compare-button:hover,
.product-feedback-button-add:hover {
  border: 1px solid #ED008C;
  transition: border-color 0.5s ease;
}

.product-link a {
  word-break: break-all;
}

.arrow-icon {
  transition: transform 0.3s ease, opacity 0.2s ease;
  transform: rotate(0deg);
}

.toggle-and-title-feedback:hover .arrow-icon {
  opacity: 0.8;
}

.feedback-section-open .arrow-icon {
  transform: rotate(180deg);
}

.slide-fade-enter-active {
  transition: all 0.4s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.2s ease-in;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-10px);
  opacity: 0;
}

.no-reviews-message {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 16px;
  padding: 40px;
  background-color: #f9f9f9;
  border-radius: 8px;
  text-align: center;
}

.no-reviews-message p {
  color: #757575;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 400;
  margin: 0;
}

.comment-icon {
  width: 48px;
  height: 48px;
  opacity: 0.5;
}

@media (max-width: 480px) {
  .product-physical-characteristics-content-characteristics {
    min-width: 100%;
    max-width: 100%;
  }
}

@media (max-width: 768px) {
  .product-physical-characteristics-content {
    gap: 12px;
  }

  .product-physical-characteristics-content-characteristics {
    min-width: calc(50% - 10px);
    max-width: calc(50% - 10px);
  }

  .product-image-and-details {
    flex-direction: column;
    align-items: center;
  }

  .product-image-and-details-img {
    width: 100%;
    height: auto;
  }

  .product-image-and-details-details {
    width: 100%;
  }
}
</style>
