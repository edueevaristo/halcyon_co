<template>
  <div v-if="open" class="modal-overlay" @click.self="closeModal">
    <div class="modal-content" role="dialog" aria-modal="true">
      <div class="modal-header">
        <div class="header-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="white"/>
          </svg>
        </div>
        <div>
          <h2 class="modal-title">Avaliar Produto</h2>
          <p class="modal-subtitle">Compartilhe sua experiência com outros usuários</p>
        </div>
        <button class="close-button" @click="closeModal" aria-label="Fechar">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18M6 6L18 18" stroke="#999" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </div>

      <form @submit.prevent="submitReview" class="modal-form">
        <div class="rating-section">
          <label class="rating-label">Sua avaliação</label>
          <div class="stars-container">
            <button
              v-for="star in 5"
              :key="star"
              type="button"
              class="star-button"
              :class="{ 'active': star <= review.stars, 'hover': star <= hoveredStar }"
              @click="setRating(star)"
              @mouseenter="hoveredStar = star"
              @mouseleave="hoveredStar = 0"
            >
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" 
                      :fill="(star <= review.stars || star <= hoveredStar) ? '#FFD700' : '#E5E5E5'"
                      :stroke="(star <= review.stars || star <= hoveredStar) ? '#FFD700' : '#E5E5E5'"
                      stroke-width="1"/>
              </svg>
            </button>
          </div>
          <p class="rating-text" v-if="review.stars">{{ getRatingText(review.stars) }}</p>
        </div>

        <div class="comment-section">
          <label for="comment" class="comment-label">Seu comentário</label>
          <textarea
              id="comment"
              v-model="review.comment"
              placeholder="Conte sobre sua experiência com este produto..."
              rows="4"
              required
              class="comment-input"
          ></textarea>
        </div>

        <div class="modal-actions">
          <button type="button" @click="closeModal" class="cancel-button">
            Cancelar
          </button>
          <button type="submit" class="submit-button" :disabled="!review.stars || !review.comment.trim()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M22 2L11 13L6 8L2 12L11 21L22 6L22 2Z" fill="white"/>
            </svg>
            Publicar Avaliação
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const open = ref(false);
const hoveredStar = ref(0);
const emit = defineEmits(["openModalAvaliation", "submitReview"]);

const review = ref({
  user_id: localStorage.getItem("user_id"),
  stars: null,
  comment: "",
});

const ratingTexts = {
  1: "Muito ruim",
  2: "Ruim", 
  3: "Regular",
  4: "Bom",
  5: "Excelente"
};

const openModalAvaliation = () => {
  open.value = true;
  emit("openModalAvaliation");
};

const closeModal = () => {
  open.value = false;
  clearForm();
};

const clearForm = () => {
  review.value = {
    user_id: localStorage.getItem("user_id"),
    stars: null,
    comment: "",
  };
  hoveredStar.value = 0;
};

const setRating = (rating) => {
  review.value.stars = rating;
};

const getRatingText = (rating) => {
  return ratingTexts[rating] || "";
};

const submitReview = () => {
  if (review.value.stars && review.value.comment.trim()) {
    emit("submitReview", review.value);
    closeModal();
  }
};

defineExpose({ openModalAvaliation });
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
  z-index: 1001;
  backdrop-filter: blur(4px);
}

.modal-content {
  background: #fff;
  border-radius: 20px;
  width: 100%;
  max-width: 500px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
  from {
    opacity: 0;
    transform: translateY(-20px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.modal-header {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 24px 24px 0 24px;
  position: relative;
}

.header-icon {
  width: 48px;
  height: 48px;
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.modal-title {
  font-family: 'Poppins', sans-serif;
  font-size: 20px;
  font-weight: 600;
  color: #141414;
  margin: 0;
}

.modal-subtitle {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  color: #757575;
  margin: 4px 0 0 0;
}

.close-button {
  position: absolute;
  top: 0;
  right: 0;
  background: none;
  border: none;
  padding: 8px;
  cursor: pointer;
  border-radius: 8px;
  transition: background-color 0.2s;
}

.close-button:hover {
  background-color: #f5f5f5;
}

.modal-form {
  padding: 24px;
}

.rating-section {
  margin-bottom: 24px;
}

.rating-label {
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 500;
  color: #ED008C;
  margin-bottom: 12px;
  display: block;
}

.stars-container {
  display: flex;
  gap: 8px;
  margin-bottom: 8px;
}

.star-button {
  background: none;
  border: none;
  cursor: pointer;
  padding: 4px;
  border-radius: 8px;
  transition: all 0.2s ease;
}

.star-button:hover {
  transform: scale(1.1);
}

.star-button.active svg,
.star-button.hover svg {
  filter: drop-shadow(0 2px 4px rgba(255, 215, 0, 0.3));
}

.rating-text {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  color: #FFD700;
  font-weight: 500;
  margin: 0;
}

.comment-section {
  margin-bottom: 24px;
}

.comment-label {
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 500;
  color: #ED008C;
  margin-bottom: 8px;
  display: block;
}

.comment-input {
  width: 100%;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  color: #141414;
  padding: 12px 16px;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  background: #fff;
  resize: vertical;
  min-height: 100px;
  transition: border-color 0.2s;
  box-sizing: border-box;
}

.comment-input:focus {
  outline: none;
  border-color: #ED008C;
  box-shadow: 0 0 0 3px rgba(237, 0, 140, 0.1);
}

.comment-input::placeholder {
  color: #a0a0a0;
}

.modal-actions {
  display: flex;
  gap: 12px;
  justify-content: flex-end;
}

.cancel-button {
  padding: 12px 20px;
  background: #f8fafc;
  color: #64748b;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.cancel-button:hover {
  background: #e2e8f0;
  border-color: #cbd5e1;
}

.submit-button {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 12px 20px;
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  color: white;
  border: none;
  border-radius: 12px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
  box-shadow: 0 4px 12px rgba(237, 0, 140, 0.3);
}

.submit-button:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(237, 0, 140, 0.4);
}

.submit-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

@media (max-width: 640px) {
  .modal-content {
    margin: 20px;
    max-width: calc(100vw - 40px);
  }
  
  .modal-header {
    padding: 20px 20px 0 20px;
  }
  
  .modal-form {
    padding: 20px;
  }
  
  .modal-actions {
    flex-direction: column;
  }
  
  .cancel-button,
  .submit-button {
    width: 100%;
    justify-content: center;
  }
}
</style>
