<template>
  <div class="compare-table-wrapper">
    <table class="compare-table">
      <thead>
      <tr>
        <th></th>
        <th v-for="(product, index) in products" :key="product.id" class="product-header">
          <img :src="product.image" alt="Imagem do produto" class="product-image"/>
          <div class="product-name">{{ product.name }}</div>
          <button @click="remove(product.name)" class="remove-btn">✖</button>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(label, key) in allAttributes" :key="key">
        <td class="attribute-label">{{ label }}</td>
        <td v-for="(product, i) in products" :key="product.id" class="attribute-value">
          <span v-if="key === 'ingredients'" class="ingredients">{{ product.attributes[key] || '-' }}</span>
          <span v-else>{{ product.attributes[key] || '-' }}</span>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import {computed} from 'vue'
import {useCompareStore} from '../stores/useCompareStore'

// Definindo os props para o componente
const props = defineProps({
  products: Array
})

const store = useCompareStore()

//  remoção do produto
function remove(name) {
  store.removeProduct(name)
}

// Computed para gerar as categorias de atributos
const allAttributes = computed(() => {
  const labels = {
    brand: 'Marca',
    category: 'Categoria',
    price: 'Preço médio',
    skinType: 'Tipo de pele',
    finish: 'Acabamento',
    coverage: 'Cobertura',
    texture: 'Textura',
    spf: 'FPS',
    shades: 'Tom',
    oilFree: 'Oil-free',
    ingredients: 'Ingredientes',
    description: 'Descrição'
  }

  const keys = new Set()
  props.products.forEach(p => Object.keys(p.attributes).forEach(k => keys.add(k)))

  return Array.from(keys).reduce((acc, key) => {
    acc[key] = labels[key] || key
    return acc
  }, {})
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
}

thead th {
  background-color: #fff;
  text-align: center;
  padding: 16px;
}

.product-header {
  vertical-align: top;
  padding: 16px;
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
  text-align: left;
  border-top: 1px solid #eee;
  color: #444;
  vertical-align: top;
}

.ingredients {
  display: block;
  max-width: 260px;
  font-size: 12px;
  overflow-wrap: break-word;
}
</style>
