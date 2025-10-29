<template>
  <div>
    <div v-if="store.modalCompare" class="modal-overlay" @click.self="store.closeModal()">
      <div class="modal-content">
        <button class="close-button" @click="store.closeModal()">✕</button>
        <h2 class="modal-title">Compare produtos</h2>
        <p class="modal-subtitle">
          Compare até dois produtos lado a lado para tomar a melhor decisão.<br><b>Podendo ser</b> sugerido pela Gllitr na decisão da compra.
        </p>

        <div v-if="store.error" class="error-message">
          {{ store.error }}
        </div>

        <div v-if="loading" style="text-align:center; padding: 32px;">
          <span>Carregando produto...</span>
        </div>

        <CompareTableComponent
            v-if="!loading"
            :initialProduct="initialProduct"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useCompareStore } from '../stores/useCompareStore'
import CompareTableComponent from './CompareTableComponent.vue'
import PostProductDataService from '../services/PostProductDataService'

const store = useCompareStore()
const initialProduct = ref(null)
const loading = ref(false)

watch(() => store.modalCompare, async (val) => {

  if (val && store.selectedProductId) {

    loading.value = true

    try {

      const response = await PostProductDataService.getById(store.selectedProductId)
      initialProduct.value = response.data.product || response.data

    } catch (e) {

      store.error = 'Erro ao buscar produto para comparação.'

    } finally {

      loading.value = false
    }

  } else {

    store.clearError()
    initialProduct.value = null
    loading.value = false
  }
})
</script>

<style scoped>
.floating-button {
  position: fixed;
  bottom: 24px;
  right: 24px;
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
  max-width: 1100px;
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

.product-selection {
  margin: 20px 0;
}

.product-selection h3 {
  margin-bottom: 15px;
  color: #333;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 15px;
  margin-bottom: 20px;
}

.product-card {
  border: 1px solid #eee;
  border-radius: 8px;
  padding: 10px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.product-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.selection-product-image {
  width: 100%;
  height: 120px;
  object-fit: contain;
  margin-bottom: 8px;
}

.selection-product-name {
  font-size: 14px;
  text-align: center;
  color: #333;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.select-container {
  margin: 20px 0;
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}
</style>