<template>
    <div>
        <!-- Botão flutuante -->
        <button class="floating-button" @click="open = true">
            <img src="/src/assets/icons/judge.svg" alt="">
        </button>

        <!-- Modal -->
        <div v-if="open" class="modal-overlay" @click.self="open = false">
            <div class="modal-content">
                <button class="close-button" @click="open = false">✕</button>

                <!-- Título -->
                <h2 class="modal-title">Compare produtos</h2>
                <p class="modal-subtitle">
                    Compare até dois produtos lado a lado para tomar a melhor decisão.
                </p>

                <!-- Mensagem de erro -->
                <div v-if="store.error" class="error-message">
                    {{ store.error }}
                </div>

                <!-- Tabela de comparação -->
                <CompareTable :products="products" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useCompareStore } from '../stores/useCompareStore'
import CompareTable from './CompareTable.vue'

const store = useCompareStore()
const open = ref(false)

// limpa erro quando fecha modal
watch(open, (val) => {
    if (!val) {
        store.clearError()
    }
})

// MOCK: será substituído pela store mais tarde
const products = ref([
    {
        name: 'Base da Virgínia',
        image: 'https://via.placeholder.com/100x100?text=Produto+1',
        attributes: {
            brand: 'WePink',
            category: 'Base',
            price: 'R$200',
            skinType: 'Seca',
            finish: 'Matte',
            coverage: 'Média',
            texture: 'Líquida',
            spf: 'Não tem',
            shades: '12 tons',
            oilFree: '-',
            ingredients: 'CYCLOPENTASILOXANE, AQUA, TRIMETHYLSILOXYSILICATE',
            description: 'Alta fixação para sua make'
        }
    },
    {
        name: 'Base BTSkin',
        image: 'https://via.placeholder.com/100x100?text=Produto+2',
        attributes: {
            brand: 'BtSkin',
            category: 'Base',
            price: 'R$79,90',
            skinType: 'Oleosa',
            finish: 'Glow',
            coverage: 'Altíssima',
            texture: 'Líquida',
            spf: '40',
            shades: '40 tons',
            oilFree: 'Sim',
            ingredients: 'Aqua, Cyclopentasiloxane, Isododecane',
            description: 'Cobertura alta com leveza'
        }
    }
])
</script>

<style scoped>
/* botão flutuante */
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
    border: 1px solid  #9400EF;
    background:  #ED008C;
    box-shadow: 0px -2px 15px -3px rgba(237, 0, 140, 0.25), 0px 4px 6px -4px #E10CFF;
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
    max-width: 900px;
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
</style>