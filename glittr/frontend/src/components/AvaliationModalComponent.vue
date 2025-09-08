<template>
  <div v-if="open" class="modal-overlay" @click.self="closeModal">
    <div class="modal-content" role="dialog" aria-modal="true">
      <button class="close-button" @click="closeModal" aria-label="Fechar">✕</button>

      <h2 class="modal-title">Cadastrar Avaliação</h2>
      <p class="modal-subtitle">Deixe sua opinião para ajudar outras pessoas!</p>

      <h4 class="modal-subtitle-2">Avaliação</h4>

      <form @submit.prevent="submitReview">
        <div class="form-group">
          <label for="stars" class="label-name">Nota:</label>
          <select
              id="stars"
              v-model.number="review.stars"
              required
              class="label-input"
          >
            <option disabled value="">Selecione</option>
            <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="comment" class="label-name">Comentário:</label>
          <textarea
              id="comment"
              v-model="review.comment"
              placeholder="Escreva seu comentário"
              rows="4"
              required
              class="label-input"
          ></textarea>
        </div>

        <button type="submit" class="submit-button">Enviar Avaliação</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const open = ref(false);
const emit = defineEmits(["openModalAvaliation", "submitReview"]);

const review = ref({
  user_id: localStorage.getItem("user_id"),
  stars: null,
  comment: "",
});

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
    user_id: null,
    stars: null,
    comment: "",
  };
};

const submitReview = () => {
  emit("submitReview", review.value);
  console.log("Avaliação enviada:", review.value);
  closeModal();
};

defineExpose({ openModalAvaliation });
</script>

<style scoped>

input, textarea, select {
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  color: #000;
}

.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 16px;
  z-index: 1001;
  overflow-y: auto;
}

.modal-content {
  background: #fff;
  border-radius: 16px;
  width: 100%;
  max-width: 600px;
  max-height: 90vh;
  padding: 32px;
  position: relative;
  overflow-y: auto;
  box-sizing: border-box;
}

.modal-content::-webkit-scrollbar {
  width: 8px;
}

.modal-content::-webkit-scrollbar-thumb {
  background-color: #ed008c;
  border-radius: 8px;
}

.modal-content::-webkit-scrollbar-track {
  background-color: #ffe6f1;
}

.close-button {
  position: absolute;
  top: 16px;
  right: 20px;
  background: none;
  border: none;
  font-size: 22px;
  color: #999;
  cursor: pointer;
}

.modal-title {
  margin-top: 0;
  font-size: 20px;
  font-weight: 600;
  color: #111;
}

.modal-subtitle {
  font-size: 14px;
  color: #777;
  margin-bottom: 24px;
}

.modal-subtitle-2 {
  margin-bottom: 16px;
  color: #b0b0b0;
  font-family: "Poppins", sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 20px;
}

.form-group {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
}

.label-name {
  color: #ed008c;
  font-family: "Poppins", sans-serif;
  font-size: 18px;
  font-weight: 500;
  line-height: 20px;
  margin-bottom: 8px;
}

.label-input {
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  padding: 10px;
  border-radius: 10px;
  border: 1px solid #757575;
  background: #fff;
  resize: vertical;
}

.label-input:focus {
  outline: none;
  border-color: #ed008c;
  box-shadow: 0 0 5px #ed008c;
}

.submit-button {
  background-color: #ed008c;
  border: none;
  color: white;
  font-weight: 600;
  padding: 12px 20px;
  border-radius: 12px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.2s ease-in-out;
}

.submit-button:hover {
  background-color: #c700b3;
}
</style>
