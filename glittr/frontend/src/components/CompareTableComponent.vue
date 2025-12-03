<template>
  <div class="compare-table-wrapper">

    <div v-if="products.length === 2" class="comparison-section">

      <div class="winner-announcement" v-if="winner !== null">
        <div class="winner-badge">
          <span class="crown-icon">👑</span>
          <span class="winner-text">VENCEDOR: {{ products[winner].name }}
            <br><a :href="products[winner].product_link" target="_blank" style="color: white !important; text-decoration: none;">Clique aqui para ir até a loja</a>
          </span>
        </div>
      </div>
      
      <div class="score-comparison">
        <div class="score-card" :class="{ 'winner': winner === 0, 'loser': winner === 1 }">
          <div class="product-header">
            <img :src="products[0].image" alt="Produto" class="product-thumb">
            <h3 class="product-title">{{ products[0].name }}</h3>
          </div>
          
          <div class="metrics-grid">
            <div class="metric-item" :class="{ 'clickable': !isPremium }" @click="handleMetricClick('reviews')">
              <div class="metric-icon star-icon">⭐</div>
              <div class="metric-content">
                <span class="metric-value">{{ isPremium ? (products[0].average_rating || 0) : '🔒 Premium' }}</span>
                <span class="metric-label">{{ isPremium ? products[0].reviews_count : '🔒 Desbloqueie' }} avaliações</span>
              </div>
            </div>
            
            <div class="metric-item" :class="{ 'clickable': !isPremium }" @click="handleMetricClick('likes')">
              <div class="metric-icon heart-icon">❤️</div>
              <div class="metric-content">
                <span class="metric-value">{{ isPremium ? (products[0].likes_count || 0) : '🔒 Premium' }}</span>
                <span class="metric-label">likes</span>
              </div>
            </div>
            
            <div class="metric-item">
              <div class="metric-icon price-icon">💰</div>
              <div class="metric-content">
                <span class="metric-value">R$ {{ products[0].price_average || 0 }}</span>
                <span class="metric-label">preço médio</span>
              </div>
            </div>
            
            <div class="metric-item">
              <div class="metric-icon attr-icon">📋</div>
              <div class="metric-content">
                <span class="metric-value">{{ (products[0].attributes && Array.isArray(products[0].attributes)) ? products[0].attributes.length : 0 }}</span>
                <span class="metric-label">atributos</span>
              </div>
            </div>
          </div>
          
          <div class="final-score">
            <span class="score-label">Pontuação</span>
            <span class="score-value">{{ calculateScore(products[0]) }}</span>
          </div>
        </div>
        
        <div class="vs-separator">
          <div class="vs-circle">
            <span class="vs-text">VS</span>
          </div>
        </div>
        
        <div class="score-card" :class="{ 'winner': winner === 1, 'loser': winner === 0 }">
          <div class="product-header">
            <img :src="products[1].image" alt="Produto" class="product-thumb">
            <h3 class="product-title">{{ products[1].name }}</h3>
          </div>
          
          <div class="metrics-grid">
            <div class="metric-item" :class="{ 'clickable': !isPremium }" @click="handleMetricClick('reviews')">
              <div class="metric-icon star-icon">⭐</div>
              <div class="metric-content">
                <span class="metric-value">{{ isPremium ? (products[1].average_rating || 0) : '🔒 Premium' }}</span>
                <span class="metric-label">{{ isPremium ? products[1].reviews_count : '🔒 Desbloqueie' }} avaliações</span>
              </div>
            </div>
            
            <div class="metric-item" :class="{ 'clickable': !isPremium }" @click="handleMetricClick('likes')">
              <div class="metric-icon heart-icon">❤️</div>
              <div class="metric-content">
                <span class="metric-value">{{ isPremium ? (products[1].likes_count || 0) : '🔒 Premium' }}</span>
                <span class="metric-label">likes</span>
              </div>
            </div>
            
            <div class="metric-item">
              <div class="metric-icon price-icon">💰</div>
              <div class="metric-content">
                <span class="metric-value">R$ {{ products[1].price_average || 0 }}</span>
                <span class="metric-label">preço médio</span>
              </div>
            </div>
            
            <div class="metric-item">
              <div class="metric-icon attr-icon">📋</div>
              <div class="metric-content">
                <span class="metric-value">{{ (products[1].attributes && Array.isArray(products[1].attributes)) ? products[1].attributes.length : 0 }}</span>
                <span class="metric-label">atributos</span>
              </div>
            </div>
          </div>
          
          <div class="final-score">
            <span class="score-label">Pontuação</span>
            <span class="score-value">{{ calculateScore(products[1]) }}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="compare-container">
      <div class="products-header">
        <div class="attribute-column-header"></div>
        <div v-for="(product, index) in 2" :key="product && product.id ? product.id : 'mock-' + index" class="product-column-header">
          <template v-if="products[index] && products[index].name">
            <img :src="products[index].image" alt="Imagem do produto" class="product-image"/>
            <div class="product-name">{{ products[index].name }}</div>
            <button @click="removeProduct(index)" class="remove-btn">✖</button>
          </template>
          <template v-else-if="index === 1 && initialProduct">
            <div class="product-image" style="background:#f3e6f9;height:90px;width:90px;border-radius:8px;margin:0 auto 8px auto;"></div>
            <Select :options="availableProducts" :placeholder="'Selecione para comparar'" @update:modelValue="selectSecondProduct"/>
          </template>
          <template v-else>
            <div class="product-image" style="background:#f3e6f9;height:90px;width:90px;border-radius:8px;margin:0 auto 8px auto;"></div>
          </template>
        </div>
      </div>
      
      <div class="attributes-container">
        <div v-for="(label, key) in allAttributes" :key="key" class="attribute-row">
          <div class="attribute-label">{{ label }}</div>
          <div v-for="(product, idx) in products" :key="'attr-' + key + '-' + idx" class="attribute-value">
            <template v-if="product && product.attributes">
              <span v-if="isIngredient(key)" class="ingredients">{{ formatAttributeValue(getAttributeValue(product.attributes, key)) || '-' }}</span>
              <span v-else>{{ formatAttributeValue(getAttributeValue(product.attributes, key)) || '-' }}</span>
            </template>
            <template v-else>
              <span style="color:#bbb;">-</span>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <PremiumModalComponent 
    :isVisible="showPremiumModal" 
    :action="modalAction" 
    @close="closePremiumModal" 
  />
</template>

<script setup>
import {computed, ref, watch, onMounted} from 'vue'
import {useCompareStore} from '../stores/useCompareStore'
import {useAuth} from '../stores/auth'
import PostProductDataService from "@/services/PostProductDataService.js"
import Select from './UI/Select.vue'
import PremiumModalComponent from './PremiumModalComponent.vue'

const props = defineProps({
  initialProduct: Object
})

const store = useCompareStore()
const auth = useAuth()
const products = ref([])
const availableProducts = ref([])
const winner = ref(null)
const categoryId = ref(null)

const isPremium = computed(() => auth.isPremium)
const showPremiumModal = ref(false)
const modalAction = ref('')

const handleMetricClick = (action) => {
  if (!isPremium.value) {
    modalAction.value = action
    showPremiumModal.value = true
  }
}

const closePremiumModal = () => {
  showPremiumModal.value = false
}

const formatForSelect = (product) => ({
  id: product.id,
  label: product.product_name || product.name,
  image_path: product.image_path,
  product_name: product.product_name || product.name,
  attributes: product.attributes
})

const getProductImage = (product) => {
  if (!product.image_path) return ''

  const hostname = window.location.hostname;
  const baseUrl = (hostname === 'localhost' || hostname === '127.0.0.1') 
      ? 'http://127.0.0.1:8000' 
      : 'https://api.glittr.com.br';

  if (Array.isArray(product.image_path)) {
    const firstImage = product.image_path[0]
    return firstImage.startsWith('http') ? firstImage : `${baseUrl}/storage/${firstImage}`
  }

  return product.image_path.startsWith('http')
      ? product.image_path
      : `${baseUrl}/storage/${product.image_path}`
}

const loadAvailableProducts = async (categoryId, excludeId) => {
  if (categoryId) {
    try {
      const response = await PostProductDataService.getAllByCategory(categoryId)
      availableProducts.value = response.data.products
          .filter(p => p.id !== excludeId)
          .map(formatForSelect)
    } catch (e) {
      console.error('Erro ao carregar produtos:', e)
    }
  }
}

const selectSecondProduct = async (productId) => {
  try {
    const response = await PostProductDataService.getById(productId)
    const product = response.data.product || response.data
    if (products.value.length < 2) {
      products.value = [...products.value, {
        id: product.id,
        name: product.product_name || product.name,
        image: getProductImage(product),
        attributes: product.attributes,
        average_rating: product.average_rating || 0,
        likes_count: product.likes_count || 0,
        reviews_count: product.reviews_count || 0,
        price_average: product.price_average || 0,
        product_link: product.product_link
      }]
    }
  } catch (e) {
    console.error('Erro ao carregar produto:', e)
  }
}

const removeProduct = (index) => {
  if (index === 0) {
    store.closeModal();
  } else {
    products.value = [products.value[0]];
  }
}

watch(() => props.initialProduct, (newVal) => {
  if (newVal) {
    products.value = [{
      id: newVal.id,
      name: newVal.product_name || newVal.name,
      image: getProductImage(newVal),
      attributes: newVal.attributes,
      average_rating: newVal.average_rating || 0,
      likes_count: newVal.likes_count || 0,
      reviews_count: newVal.reviews_count || 0,
      price_average: newVal.price_average || 0,
      product_link: newVal.product_link
    }]
    categoryId.value = newVal.category.id
    loadAvailableProducts(newVal.category.id, newVal.id)
  } else {
    products.value = []
  }
}, {immediate: true})

const isIngredient = (key) => {
  return key.toLowerCase().includes('ingrediente')
}

const formatAttributeValue = (value) => {
  if (value === true) return 'SIM';
  if (value === false) return 'NÃO';
  if (typeof value === 'string') {
    return value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
  }
  return value
}

const getAttributeValue = (attributes, name) => {
  const attr = attributes.find(a => a.name.toLowerCase() === name.toLowerCase())
  return attr ? attr.value : null
}

const calculateScore = (product) => {
  if (!product) return 0
  
  // Para usuários não premium, usar valores padrão para cálculo
  const rating = isPremium.value ? (product.average_rating || 0) : 3.5
  const likes = isPremium.value ? (product.likes_count || 0) : 15
  const reviews = isPremium.value ? (product.reviews_count || 0) : 8
  const attributes = (product.attributes && Array.isArray(product.attributes)) ? product.attributes.length : 0
  const price = product.price_average || 50
  
  const priceBonus = price > 0 ? Math.max(0, (100 - price) * 0.1) : 0
  return Math.round((rating * 3) + (likes * 0.1) + (reviews * 0.8) + (attributes * 0.5) + priceBonus)
}

const determineWinner = () => {
  if (products.value.length < 2) {
    winner.value = null
    return
  }

  const score1 = calculateScore(products.value[0])
  const score2 = calculateScore(products.value[1])

  if (score1 > score2) winner.value = 0
  else if (score2 > score1) winner.value = 1
  else winner.value = null
}

watch(products, determineWinner, {deep: true})

const allAttributes = computed(() => {
  const labels = {
    'ingredientes': 'Ingredientes',
    'tipo de pele': 'Tipo de pele',
    'textura': 'Textura',
    'tem fps (sim/não)': 'Tem FPS',
    'fator de proteção solar (fps)': 'FPS',
    'comedogênico (sim/não)': 'Comedogênico',
    'vegano (sim/não)': 'Vegano',
    'cruelty-free (sim/não)': 'Cruelty-free',
    'fragrância (sim/não)': 'Fragrância',
    'marca': 'Marca',
    'categoria': 'Categoria',
    'preço médio': 'Preço',
    'acabamento': 'Acabamento',
    'cobertura': 'Cobertura',
    'tom': 'Tom',
    'oil-free': 'Oil-free',
    'descrição': 'Descrição'
  }

  const allKeys = new Set()

  products.value
      .filter(p => p && p.attributes && Array.isArray(p.attributes))
      .forEach(p => {
        p.attributes.forEach(attr => {
          if (attr.name) {
            allKeys.add(attr.name.toLowerCase())
          }
        })
      })

  return Array.from(allKeys).reduce((acc, key) => {
    const label = labels[key] || key
    acc[key] = typeof label === 'string' ? label.charAt(0).toUpperCase() + label.slice(1) : label
    return acc
  }, {})
})

onMounted(async () => {
  if (products.value.length > 0 && products.value[0]?.category_id) {
    const response = await PostProductDataService.getAllByCategory(products.value[0].category_id)
    availableProducts.value = response.data.products.map(formatForSelect)
  }
})
</script>

<style scoped>
.compare-table-wrapper {
  overflow-x: auto;
  padding: 16px;
  width: 100%;
  max-width: 100vw;
  box-sizing: border-box;
}

.comparison-section {
  margin-bottom: 32px;
}

.winner-announcement {
  text-align: center;
  margin-bottom: 24px;
}

.winner-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  color: white;
  padding: 12px 24px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 16px;
  box-shadow: 0 8px 32px rgba(237, 0, 140, 0.3);
  animation: pulse 2s infinite;
  margin-bottom: 16px;
}



.winner-link {
  margin-top: 8px;
  font-size: 12px;
}

.product-link {
  color: white !important;
  text-decoration: underline;
  font-size: 12px;
  word-break: break-all;
  transition: opacity 0.2s ease;
}

.product-link:hover {
  opacity: 0.8;
}

.product-link:visited {
  color: white !important;
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.crown-icon {
  font-size: 20px;
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
  40% { transform: translateY(-8px); }
  60% { transform: translateY(-4px); }
}

.score-comparison {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  gap: 24px;
  align-items: stretch;
}

.score-card {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 2px solid #e2e8f0;
  border-radius: 20px;
  padding: 24px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
  min-height: 320px;
  display: flex;
  flex-direction: column;
}

.score-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #ED008C 0%, #E10CFF 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.score-card.winner {
  background: linear-gradient(135deg, #fef7ff 0%, #ffffff 100%);
  border-color: #ED008C;
  box-shadow: 0 20px 40px rgba(237, 0, 140, 0.15);
  transform: translateY(-4px);
}

.score-card.winner::before {
  opacity: 1;
}

.score-card.loser {
  opacity: 0.8;
  transform: translateY(2px);
}

.product-header {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  gap: 12px;
  margin-bottom: 20px;
  padding-bottom: 16px;
  border-bottom: 1px solid #f1f5f9;
}

.product-thumb {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  object-fit: cover;
  border: 2px solid #f1f5f9;
}

.product-title {
  margin: 0;
  font-size: 16px;
  font-weight: 600;
  color: #1e293b;
  line-height: 1.3;
  text-align: center;
}

.metrics-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 20px;
  flex: 1;
}

.metric-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px;
  background: #f8fafc;
  border-radius: 12px;
  transition: background-color 0.2s ease;
}

.metric-item:hover {
  background: #f1f5f9;
}

.metric-item.clickable {
  cursor: pointer;
  transition: all 0.2s ease;
}

.metric-item.clickable:hover {
  background: #e3f2fd;
  transform: translateY(-1px);
}

.metric-icon {
  font-size: 18px;
  width: 24px;
  text-align: center;
}

.metric-content {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.metric-value {
  font-size: 14px;
  font-weight: 700;
  color: #1e293b;
}

.metric-label {
  font-size: 11px;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.final-score {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
  border-radius: 12px;
  margin-top: auto;
}

.score-label {
  font-size: 14px;
  font-weight: 600;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.score-value {
  font-size: 28px;
  font-weight: 800;
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.vs-separator {
  display: flex;
  align-items: center;
  justify-content: center;
}

.vs-circle {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #ED008C 0%, #E10CFF 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 32px rgba(237, 0, 140, 0.3);
  position: relative;
}

.vs-circle::before {
  content: '';
  position: absolute;
  inset: 4px;
  background: white;
  border-radius: 50%;
}

.vs-text {
  font-size: 18px;
  font-weight: 800;
  color: #ED008C;
  position: relative;
  z-index: 1;
}

.compare-container {
  width: 100%;
  border: 1px solid #e5e5e5;
  border-radius: 12px;
  overflow: hidden;
  background: #fff;
  font-family: sans-serif;
}

.products-header {
  display: grid;
  grid-template-columns: 200px 1fr 1fr;
  background-color: #f8fafc;
  border-bottom: 2px solid #e5e5e5;
}

.attribute-column-header {
  padding: 16px;
}

.product-column-header {
  padding: 16px;
  text-align: center;
  border-left: 1px solid #e5e5e5;
}

.product-image {
  height: 90px;
  width: 90px;
  object-fit: cover;
  border-radius: 8px;
  margin: 0 auto 8px;
  display: block;
}

.product-name {
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
}

.attributes-container {
  display: flex;
  flex-direction: column;
}

.attribute-row {
  display: grid;
  grid-template-columns: 200px 1fr 1fr;
  border-bottom: 1px solid #f0f0f0;
}

.attribute-row:last-child {
  border-bottom: none;
}

.attribute-label {
  font-weight: 600;
  color: #e91e63;
  padding: 12px 16px;
  background: #fafafa;
  border-right: 1px solid #e5e5e5;
}

.attribute-value {
  padding: 12px 16px;
  text-align: center;
  color: #444;
  border-left: 1px solid #f0f0f0;
}

.ingredients {
  display: block;
  max-width: 260px;
  font-size: 12px;
  overflow-wrap: break-word;
}

.remove-btn {
  background-color: #e91e63;
  color: white;
  border: none;
  border-radius: 4px;
  height: 30px;
  width: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 8px auto 0;
  cursor: pointer;
  transition: background-color 0.2s;
}

.remove-btn:hover {
  background-color: #c2185b;
}

@media (max-width: 1024px) {
  .compare-table-wrapper {
    padding: 12px;
  }
  
  .products-header {
    grid-template-columns: 150px 1fr 1fr;
  }
  
  .attribute-row {
    grid-template-columns: 150px 1fr 1fr;
  }
  
  .attribute-label {
    font-size: 14px;
    padding: 10px 12px;
  }
  
  .attribute-value {
    font-size: 14px;
    padding: 10px 12px;
  }
}

@media (max-width: 768px) {
  .score-comparison {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  
  .vs-separator {
    order: 2;
    margin: 8px 0;
  }
  
  .vs-circle {
    width: 60px;
    height: 60px;
  }
  
  .vs-text {
    font-size: 16px;
  }
  
  .compare-container {
    overflow-x: auto;
  }
  
  .products-header {
    grid-template-columns: 120px 1fr 1fr;
    min-width: 480px;
  }
  
  .attribute-row {
    grid-template-columns: 120px 1fr 1fr;
    min-width: 480px;
  }
  
  .attribute-label {
    font-size: 12px;
    padding: 8px 10px;
  }
  
  .attribute-value {
    font-size: 12px;
    padding: 8px 10px;
  }
  
  .product-image {
    width: 60px;
    height: 60px;
  }
  
  .product-name {
    font-size: 12px;
  }
}

@media (max-width: 640px) {
  .score-card {
    padding: 16px;
    min-height: auto;
  }
  
  .metrics-grid {
    grid-template-columns: 1fr;
    gap: 10px;
  }
  
  .product-thumb {
    width: 36px;
    height: 36px;
  }
  
  .product-title {
    font-size: 13px;
  }
  
  .winner-badge {
    font-size: 13px;
    padding: 10px 16px;
    flex-direction: column;
    gap: 4px;
  }
  
  .final-score {
    flex-direction: column;
    gap: 6px;
    text-align: center;
    padding: 12px;
  }
  
  .score-value {
    font-size: 22px;
  }
  
  .metric-item {
    padding: 8px;
  }
  
  .metric-value {
    font-size: 13px;
  }
  
  .metric-label {
    font-size: 10px;
  }
}

@media (max-width: 480px) {
  .compare-table-wrapper {
    padding: 8px;
  }
  
  .products-header {
    grid-template-columns: 100px 1fr 1fr;
    min-width: 400px;
  }
  
  .attribute-row {
    grid-template-columns: 100px 1fr 1fr;
    min-width: 400px;
  }
  
  .attribute-label {
    font-size: 11px;
    padding: 6px 8px;
  }
  
  .attribute-value {
    font-size: 11px;
    padding: 6px 8px;
  }
  
  .product-image {
    width: 50px;
    height: 50px;
  }
  
  .product-name {
    font-size: 11px;
  }
  
  .remove-btn {
    width: 24px;
    height: 24px;
    font-size: 12px;
  }
  
  .ingredients {
    max-width: 120px;
    font-size: 10px;
  }
  
  .winner-badge {
    font-size: 12px;
    padding: 8px 12px;
  }
  
  .crown-icon {
    font-size: 16px;
  }
  
  .score-card {
    padding: 12px;
  }
  
  .metric-item {
    padding: 6px;
    gap: 6px;
  }
  
  .metric-icon {
    font-size: 14px;
    width: 20px;
  }
  
  .score-value {
    font-size: 20px;
  }
}
</style>