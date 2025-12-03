<template>
  <div>

    <button v-if="!hideButton" class="add-product-button" @click="open = true">
      <img src="@/assets/icons/add.svg" alt="Adicionar produto" class="icon">
      <span class="text">Adicionar produtos</span>
    </button>

    <div v-if="open" class="modal-overlay" @click.self="closeModal">
      <div class="modal-content">
        <button class="close-button" @click="closeModal">✕</button>
        
        <div class="modal-header">
          <h2 class="modal-title">Cadastrar Produtos</h2>
          <p class="modal-subtitle">
            Preencha os campos abaixo com as informações que você tem. Quanto mais completo, melhor para ajudar outras
            pessoas a encontrarem o produto ideal!
          </p>
          <h4 class="modal-subtitle-2">Informações gerais</h4>
        </div>
        
        <div class="modal-body">
          <FormInputRegisterProductComponent @product-updated="handleProductRegistered" @close-modal="showModal = false"/>
        </div>
      </div>
    </div>
  </div>

</template>

<script setup>
import { ref } from 'vue';
import FormInputRegisterProductComponent from "@/components/FormInputRegisterProductComponent.vue";

const props = defineProps({
  hideButton: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['click']);
const open = ref(false);

const openModal = () => {
  open.value = true;
  emit('click');
};

const closeModal = () => {
  open.value = false;
};

const handleProductRegistered = () => {
  closeModal();
  // Emite evento para recarregar produtos
  window.dispatchEvent(new CustomEvent('product-updated'));
};

</script>

<style scoped>

.add-product-icon {
  width: 100%;
  height: 100%;
  object-fit: contain;
  cursor: pointer;

}

.modal-overlay {
  position: fixed;
  inset: 0;
  background: linear-gradient(135deg, rgba(237, 0, 140, 0.1) 0%, rgba(148, 0, 239, 0.1) 100%), rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
  z-index: 1001;
  backdrop-filter: blur(8px);
  animation: fadeIn 0.3s ease-out;
  overflow: hidden;
}

.modal-content {
  background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
  border-radius: 24px;
  width: 100%;
  max-width: 1100px;
  max-height: 85vh;
  position: relative;
  box-sizing: border-box;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(237, 0, 140, 0.1);
  animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.modal-header {
  padding: 32px 40px 0 40px;
  flex-shrink: 0;
}

.modal-body {
  padding: 20px 40px 40px 40px;
  overflow-y: auto;
  flex: 1;
  min-height: 0;
}

.modal-body::-webkit-scrollbar {
  width: 6px;
}

.modal-body::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  border-radius: 6px;
}

.modal-body::-webkit-scrollbar-track {
  background: rgba(237, 0, 140, 0.1);
  border-radius: 6px;
  margin: 8px 0;
}

.modal-body::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #c8007a 0%, #cc0ae6 100%);
}


.close-button {
  position: absolute;
  top: 24px;
  right: 28px;
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 50%;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  font-weight: 500;
  color: #6c757d;
  cursor: pointer;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  z-index: 10;
}

.close-button:hover {
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  color: white;
  transform: scale(1.08);
  box-shadow: 0 6px 20px rgba(237, 0, 140, 0.35);
  border-color: transparent;
}

.close-button:active {
  transform: scale(0.95);
}

.modal-title {
  margin: 0 0 12px 0;
  font-size: 28px;
  font-weight: 700;
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-family: 'Poppins', sans-serif;
  position: relative;
  padding-bottom: 12px;
}

.modal-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, #ED008C 0%, #E10CFF 100%);
  border-radius: 2px;
}

.modal-subtitle {
  font-size: 16px;
  color: #6c757d;
  margin: 16px 0 24px 0;
  line-height: 1.6;
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
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
  align-items: center;
  gap: 12px;
  margin: 20px 0 0 0;
  color: #495057;
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  font-weight: 600;
  position: relative;
}

.modal-subtitle-2::before {
  content: '📝';
  font-size: 20px;
}

.modal-subtitle-2::after {
  content: '';
  flex: 1;
  height: 1px;
  background: linear-gradient(90deg, rgba(237, 0, 140, 0.3) 0%, transparent 100%);
  margin-left: 16px;
}
.add-product-button {
  display: flex;
  height: 48px;
  padding: 16px 24px;
  justify-content: center;
  align-items: center;
  gap: 12px;
  border-radius: 12px;
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  border: none;
  cursor: pointer;
  color: white;
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  font-weight: 600;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 12px rgba(237, 0, 140, 0.3);
  position: relative;
  overflow: hidden;
}

.add-product-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.add-product-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(237, 0, 140, 0.4);
}

.add-product-button:hover::before {
  left: 100%;
}

.add-product-button:active {
  transform: translateY(-1px);
}

.add-product-button .icon {
  width: 16px;
  height: 16px;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

@media (max-width: 768px) {
  .modal-content {
    padding: 24px;
    margin: 8px;
    border-radius: 20px;
  }
  
  .modal-title {
    font-size: 24px;
  }
  
  .modal-subtitle {
    font-size: 14px;
  }
  
  .add-product-button .text {
    display: none;
  }
  
  .add-product-button {
    padding: 12px;
    border-radius: 50%;
    width: 48px;
    height: 48px;
  }
}
</style>