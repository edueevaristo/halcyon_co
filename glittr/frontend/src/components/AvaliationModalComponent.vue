<template>
  <div>
    <div v-if="open" class="modal-overlay" @click.self="closeModal">
      <div class="modal-content">
        <button class="close-button" @click="closeModal">✕</button>

        <h2 class="modal-title">Cadastrar Avaliação</h2>
        <p class="modal-subtitle">
          Deixe sua opinião para ajudar outras pessoas!
        </p>

        <h4 class="modal-subtitle-2">Avaliação</h4>

        <form @submit.prevent="submitReview">
          <div class="form-group">
            <label for="name">Nome:</label>
            <input id="name" v-model="review.name" required type="text" placeholder="Seu nome" />
          </div>

          <div class="form-group">
            <label for="rating">Nota:</label>
            <select id="rating" v-model.number="review.rating" required>
              <option disabled value="">Selecione</option>
              <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
            </select>
          </div>

          <div class="form-group">
            <label for="comment">Comentário:</label>
            <textarea
              id="comment"
              v-model="review.comment"
              placeholder="Escreva seu comentário"
              rows="4"
              required
            ></textarea>
          </div>

          <button type="submit" class="submit-button">Enviar Avaliação</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const open = ref(false);

const review = ref({
  name: "",
  rating: null,
  comment: "",
});

const closeModal = () => {
  open.value = false;
  clearForm();
};

const clearForm = () => {
  review.value = {
    name: "",
    rating: null,
    comment: "",
  };
};

const submitReview = () => {

    console.log("Avaliação enviada:", review.value);

  closeModal();
};
</script>

<style scoped>

.add-product-icon {
  width: 100%;
  height: 100%;
  object-fit: contain;
  cursor: pointer;
}

.floating-button {
  position: fixed;
  bottom: 24px;
  right: 100px;
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  z-index: 1000;
  display: flex;
  width: 60px;
  height: 60px;
  padding: 13px;
  justify-content: center;
  align-items: center;
  flex-shrink: 0;
  border-radius: 9999px;
  border: 1px solid #9400EF;
  background: #ED008C;
  box-shadow: 0 -2px 15px -3px rgba(237, 0, 140, 0.25), 0 4px 6px -4px #E10CFF;
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
  color: #B0B0B0;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 20px;
}

.form-group {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
}

label {
  font-weight: 600;
  margin-bottom: 8px;
}

input[type="text"],
select,
textarea {
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
  font-family: inherit;
  resize: vertical;
}

input[type="text"]:focus,
select:focus,
textarea:focus {
  outline: none;
  border-color: #ED008C;
  box-shadow: 0 0 5px #ED008C;
}

.submit-button {
  background-color: #ED008C;
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
  background-color: #C700B3;
}
</style>