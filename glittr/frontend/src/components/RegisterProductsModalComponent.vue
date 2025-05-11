<template>
  <div>

    <button class="floating-button" @click="open = true">
      Cadastrar Produto
    </button>

    <div v-if="open" class="modal-overlay" @click.self="closeModal">
      <div class="modal-content">
        <button class="close-button" @click="closeModal">✕</button>

        <h2 class="modal-title">Cadastrar Produtos</h2>
        <p class="modal-subtitle">
          Preencha os campos abaixo com as informações que você tem. Quanto mais completo, melhor para ajudar outras
          pessoas a encontrarem o produto ideal!
        </p>

        <h4 class="modal-subtitle-2">
          Informações gerais
        </h4>

        <FormInputRegisterProductComponent @product-registered="handleProductRegistered"/>

      </div>
    </div>
  </div>

</template>

<script setup>
import { ref } from 'vue';
import FormInputRegisterProductComponent from "@/components/FormInputRegisterProductComponent.vue";

const open = ref(false);

const openModal = () => {
  open.value = true;
};

const closeModal = () => {
  open.value = false;
};

const handleProductRegistered = () => {
  closeModal();
};
</script>

<style scoped>

/* botão flutuante */
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
  max-width: 900px;
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
  background-color: #ED008C;
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

.error-message {
  background-color: #ffe2e6;
  color: #b71c1c;
  padding: 12px 16px;
  border-radius: 8px;
  font-size: 14px;
  margin-bottom: 20px;
}

.modal-subtitle-2 {
  display: flex;
  width: 100%;
  height: 20px;
  flex-direction: column;
  justify-content: center;
  color: #B0B0B0;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px;
}
</style>