<template>
    <section class="review-form-container">
      <header class="review-header">
        <p class="review-header-text">
          Sua opinião faz a Glittr brilhar! Avalie com estrelas e conte como foi
          usar esse produto.
        </p>
        <div class="star-rating-container">
          <img
            v-for="(star, index) in 5"
            :key="index"
            :src="getStarImage(index)"
            :class="getStarClass(index)"
            @click="setRating(index + 1)"
            alt="Rating star"
          />
        </div>
      </header>
      <p class="review-instruction-text">
        Conta pra gente como foi usar o produto! Funcionou bem? Você curtiu? Sua
        opinião vai ajudar outras pessoas a decidirem melhor.
      </p>
      <textarea class="review-textarea" v-model="reviewText"></textarea>
      <footer class="review-actions">
        <button class="cancel-button" @click="cancelReview">
          Cancelar avaliação
        </button>
        <button class="submit-button" @click="submitReview">
          <img src="https://cdn.builder.io/api/v1/image/assets/739f0205fef94c40ae4e029fa55e2856/e186934a56c5ad6b6126a3a100be63d0e52adf21?placeholderIfAbsent=true" class="submit-icon" alt="Submit icon" />
          <span class="submit-text">Enviar avaliação</span>
        </button>
      </footer>
    </section>
  </template>
  
  <script>
  export default {
    name: 'ProductReviewForm',
    data() {
      return {
        rating: 0,
        reviewText: '',
      };
    },
    methods: {
      setRating(value) {
        this.rating = value;
      },
      getStarImage(index) {
        // Return different star images based on the current rating
        if (index < this.rating) {
          return 'https://cdn.builder.io/api/v1/image/assets/739f0205fef94c40ae4e029fa55e2856/d4791b9b10445fadd5ed45730036b1138b8f19eb?placeholderIfAbsent=true'; // Filled star
        } else if (index === 2 && this.rating > 2) {
          return 'https://cdn.builder.io/api/v1/image/assets/739f0205fef94c40ae4e029fa55e2856/918dfb0112be384a399f0e605f72e236c1f769d6?placeholderIfAbsent=true'; // Special star for position 3
        } else if (index === 3 && this.rating > 3) {
          return 'https://cdn.builder.io/api/v1/image/assets/739f0205fef94c40ae4e029fa55e2856/3aabbfadaa6accb7ce7b644d2ae37d3c4f5ddade?placeholderIfAbsent=true'; // Special star for position 4
        } else {
          return 'https://cdn.builder.io/api/v1/image/assets/739f0205fef94c40ae4e029fa55e2856/d4791b9b10445fadd5ed45730036b1138b8f19eb?placeholderIfAbsent=true'; // Empty star (using the same URL as filled for now)
        }
      },
      getStarClass(index) {
        // Return the appropriate class for each star
        if (index === 2) {
          return 'star-image star-image-medium';
        } else if (index === 3) {
          return 'star-image star-image-small';
        } else {
          return 'star-image';
        }
      },
      cancelReview() {
        this.rating = 0;
        this.reviewText = '';
        this.$emit('cancel');
      },
      submitReview() {
        if (this.rating > 0) {
          this.$emit('submit', {
            rating: this.rating,
            review: this.reviewText
          });
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .review-form-container {
    justify-content: center;
    align-items: stretch;
    align-self: stretch;
    border-radius: 25px;
    border: 1px solid var(--Rosa-Shockkk, #ed008c);
    display: flex;
    max-width: 795px;
    padding: 15px;
    flex-direction: column;
  }
  
  .review-header {
    align-items: stretch;
    border-bottom: 1px solid var(--Cinza-Claro, #d9d9d9);
    display: flex;
    width: 100%;
    padding: 15px 0;
    flex-direction: column;
    justify-content: start;
  }
  
  @media (max-width: 991px) {
    .review-header {
      max-width: 100%;
    }
  }
  
  .review-header-text {
    color: #757575;
    font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.2;
  }
  
  @media (max-width: 991px) {
    .review-header-text {
      max-width: 100%;
    }
  }
  
  .star-rating-container {
    align-self: start;
    display: flex;
    margin-top: 15px;
    align-items: center;
    gap: 5px;
    justify-content: start;
  }
  
  .star-image {
    aspect-ratio: 1;
    object-fit: contain;
    object-position: center;
    width: 27px;
    align-self: stretch;
    margin-top: auto;
    margin-bottom: auto;
    flex-shrink: 0;
    cursor: pointer;
  }
  
  .star-image-medium {
    width: 29px;
  }
  
  .star-image-small {
    aspect-ratio: 1.04;
    width: 28px;
  }
  
  .review-instruction-text {
    color: #757575;
    font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 17px;
    margin-top: 15px;
  }
  
  @media (max-width: 991px) {
    .review-instruction-text {
      max-width: 100%;
    }
  }
  
  .review-textarea {
    border-radius: 25px;
    border: 1px solid var(--Cinza-Mdio, #b0b0b0);
    background-color: #fff;
    display: flex;
    min-height: 160px;
    margin-top: 15px;
    width: 100%;
    padding: 10px;
    font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
    font-size: 14px;
    resize: vertical;
  }
  
  @media (max-width: 991px) {
    .review-textarea {
      max-width: 100%;
    }
  }
  
  .review-actions {
    display: flex;
    margin-top: 15px;
    width: 100%;
    align-items: start;
    gap: 10px;
    font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
    font-size: 14px;
    text-align: center;
    line-height: 1.2;
    justify-content: flex-end;
    flex-wrap: wrap;
  }
  
  @media (max-width: 991px) {
    .review-actions {
      max-width: 100%;
    }
  }
  
  .cancel-button {
    color: #757575;
    align-self: stretch;
    border-radius: 10px;
    min-height: 44px;
    padding: 14px 10px;
    gap: 15px;
    font-weight: 400;
    background-color: #d9d9d9;
    border: none;
    cursor: pointer;
  }
  
  .submit-button {
    border-radius: 10px;
    display: flex;
    padding: 10px;
    align-items: center;
    gap: 15px;
    color: #fff;
    font-weight: 500;
    justify-content: start;
    background-color: #ed008c;
    border: none;
    cursor: pointer;
  }
  
  .submit-icon {
    aspect-ratio: 1;
    object-fit: contain;
    object-position: center;
    width: 24px;
    align-self: stretch;
    margin-top: auto;
    margin-bottom: auto;
    flex-shrink: 0;
  }
  
  .submit-text {
    color: #fff;
    align-self: stretch;
    margin-top: auto;
    margin-bottom: auto;
  }
  </style>
  