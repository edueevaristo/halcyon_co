<template>
  <div class="compare-table-wrapper">
    <table class="compare-table" :class="{ 'winner-left': winner === 0, 'winner-right': winner === 1 }">
      <thead>
      <tr>
        <th></th>
        <th v-for="(product, index) in 2" :key="product && product.id ? product.id : 'mock-' + index"
            class="product-header">
          <template v-if="products[index] && products[index].name">
            <img :src="products[index].image" alt="Imagem do produto" class="product-image"/>
            <div class="product-name">{{ products[index].name }}</div>
            <button @click="removeProduct(index)" class="remove-btn">✖</button>
          </template>
          <template v-else-if="index === 1 && initialProduct">
            <div class="product-image"
                 style="background:#f3e6f9;height:90px;width:90px;border-radius:8px;margin:0 auto 8px auto;"></div>
            <Select
                :options="availableProducts"
                :placeholder="'Selecione para comparar'"
                @update:modelValue="selectSecondProduct"
            />
          </template>
          <template v-else>
            <div class="product-image"
                 style="background:#f3e6f9;height:90px;width:90px;border-radius:8px;margin:0 auto 8px auto;"></div>
          </template>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(label, key) in allAttributes" :key="key">
        <td class="attribute-label">{{ label }}</td>
        <td v-for="(product, idx) in products" :key="'attr-' + key + '-' + idx" class="attribute-value">
          <template v-if="product && product.attributes">
            <span v-if="isIngredient(key)" class="ingredients">{{
                formatAttributeValue(getAttributeValue(product.attributes, key)) || '-'
              }}</span>
            <span v-else>{{ formatAttributeValue(getAttributeValue(product.attributes, key)) || '-' }}</span>
          </template>
          <template v-else>
            <span style="color:#bbb;">-</span>
          </template>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import {computed, ref, watch, onMounted} from 'vue'
import {useCompareStore} from '../stores/useCompareStore'
import PostProductDataService from "@/services/PostProductDataService.js"
import Select from './UI/Select.vue'

const props = defineProps({
  initialProduct: Object
})

const store = useCompareStore()
const products = ref([])
const availableProducts = ref([])
const winner = ref(null)
const categoryId = ref(null)

// Formata os produtos para o select
const formatForSelect = (product) => ({
  id: product.id,
  label: product.product_name || product.name,
  image_path: product.image_path,
  product_name: product.product_name || product.name,
  attributes: product.attributes
})

const getProductImage = (product) => {
  if (!product.image_path) return ''

  if (Array.isArray(product.image_path)) {
    const firstImage = product.image_path[0]
    return firstImage.startsWith('http') ? firstImage : `http://127.0.0.1:8000${firstImage.replace(/^\/storage\//, '')}`
  }

  return product.image_path.startsWith('http')
      ? product.image_path
      : `http://127.0.0.1:8000${product.image_path.replace(/^\/storage\//, '')}`
}

const loadAvailableProducts = async (categoryId, excludeId) => {
  if (categoryId) {
    try {
      const response = await PostProductDataService.getAllByCategory(categoryId)
      console.log('Opa', response);
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
        attributes: product.attributes
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
      attributes: newVal.attributes
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

  return value
}

const getAttributeValue = (attributes, name) => {

  const attr = attributes.find(a => a.name.toLowerCase() === name.toLowerCase())
  return attr ? attr.value : null
}

const determineWinner = () => {

  if (products.value.length < 2) {

    winner.value = null
    return
  }

  const product1 = products.value[0]
  const product2 = products.value[1]

  const count0 = (product1?.attributes && Array.isArray(product1.attributes)) ? product1.attributes.length : 0
  const count1 = (product2?.attributes && Array.isArray(product2.attributes)) ? product2.attributes.length : 0

  if (count0 > count1) winner.value = 0
  else if (count1 > count0) winner.value = 1
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
    acc[key] = labels[key] || key
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
}

.compare-table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #e5e5e5;
  border-radius: 12px;
  overflow: hidden;
  background: #fff;
  font-family: sans-serif;
  transition: all 0.3s ease;
}

.compare-table.winner-left th:nth-child(2),
.compare-table.winner-left td:nth-child(2) {
  position: relative;
}

.compare-table.winner-left th:nth-child(2)::after,
.compare-table.winner-left td:nth-child(2)::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 3px solid #ED008C;
  border-radius: 8px;
  pointer-events: none;
  z-index: 1;
}

.compare-table.winner-right th:nth-child(3),
.compare-table.winner-right td:nth-child(3) {
  position: relative;
}

.compare-table.winner-right th:nth-child(3)::after,
.compare-table.winner-right td:nth-child(3)::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 3px solid #ED008C;
  border-radius: 8px;
  pointer-events: none;
  z-index: 1;
}

thead th {
  background-color: #fff;
  text-align: center;
  padding: 16px;
}

.product-header {
  vertical-align: top;
  padding: 16px;
  position: relative;
}

.product-image {
  height: 90px;
  margin-bottom: 8px;
}

.product-name {
  font-weight: 600;
  color: #333;
}

.attribute-label {
  font-weight: 600;
  color: #e91e63;
  text-align: left;
  padding: 12px 16px;
  border-top: 1px solid #eee;
  width: 30%;
  vertical-align: top;
}

.attribute-value {
  padding: 12px 16px;
  text-align: center;
  border-top: 1px solid #eee;
  color: #444;
  vertical-align: top;
  position: relative;
}

.ingredients {
  display: block;
  max-width: 260px;
  font-size: 12px;
  overflow-wrap: break-word;
}

.remove-btn {
  background-color: #e91e63;
  height: 30px;
  align-items: center;
  text-align: center;
  padding: auto;
  display: flex;
  justify-content: center;
  margin: 0 auto;
}
</style>