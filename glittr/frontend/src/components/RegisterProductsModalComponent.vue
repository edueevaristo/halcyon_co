<template>
  <div>
    <!-- Botão flutuante -->
    <button class="floating-button" @click="open = true">
      Cadastrar Produto
    </button>

    <!-- Modal -->
    <div v-if="open" class="modal-overlay" @click.self="open = false">
      <div class="modal-content">
        <button class="close-button" @click="open = false">✕</button>

        <!-- Título -->
        <h2 class="modal-title">Cadastrar Produtos</h2>
        <p class="modal-subtitle">
          Preencha os campos abaixo com as informações que você tem. Quanto mais completo, melhor para ajudar outras
          pessoas a encontrarem o produto ideal!
        </p>

        <h4 class="modal-subtitle-2">
          Informações gerais
        </h4>

        <FormInputRegisterProductComponent/>

        <!-- Mensagem de erro -->
        <!--        <div v-if="store.error" class="error-message">-->
        <!--          {{ store.error }}-->
        <!--        </div>-->

      </div>
    </div>
  </div>

</template>

<script setup>

import {ref} from 'vue'
import FormInputRegisterProductComponent from "@/components/FormInputRegisterProductComponent.vue";

const open = ref(false)


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
  align-items: flex-start;
  padding-top: 60px;
  z-index: 1001;
}

/* modal */
.modal-content {
  background: #fff;
  border-radius: 16px;
  max-width: 1200px;
  width: 100%;
  padding: 32px;
  position: relative;
  overflow: auto;
  max-height: 90vh;
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