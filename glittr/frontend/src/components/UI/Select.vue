<template>
  <div class="custom-select-wrapper">
    <div class="custom-select" @click="toggleDropdown">
      <div class="selected-option">
        <img v-if="selectedOption && selectedOption.image" :src="selectedOption.image" class="option-image" alt=""/>
        <span style="color: gray;font-size: medium;font-weight: 500;">{{
            selectedOption ? selectedOption.label : placeholder
          }}</span>
        <span class="arrow">▼</span>
      </div>
    </div>
    <ul v-if="dropdownOpen" class="options-list">
      <li v-if="!(Array.isArray(options) && options.length)" class="option-item no-options">
        Nenhum produto disponível para comparar :(
      </li>
      <li v-for="option in (Array.isArray(options) ? options : [])" :key="option.value" @click="selectOption(option)"
          class="option-item">
        <img v-if="option.image" :src="getImageUrl(option.image_path[0])"
             class="option-image" alt=""/>
        <span style="color: gray;font-size: medium;font-weight: 400;">{{ option.product_name }}</span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import {ref, computed, watch} from 'vue'

const props = defineProps({
  options: {
    type: Array,
    required: true,
  },
  modelValue: {
    type: [String, Number, Object],
    default: null
  },
  placeholder: {
    type: String,
    default: 'Selecione uma opção'
  }
})

const emit = defineEmits(['update:modelValue'])

const dropdownOpen = ref(false)

const selectedOption = computed(() => {
  const opts = Array.isArray(props.options) ? props.options : [];
  // Se options são produtos, use id
  return opts.find(opt => opt.id === props.modelValue) || null
})

function toggleDropdown() {
  dropdownOpen.value = !dropdownOpen.value
}

function selectOption(option) {
  // Se options são produtos, emita o id
  emit('update:modelValue', option.id)
  dropdownOpen.value = false
}

function getImageUrl(imagePath) {
  if (!imagePath) return ''
  if (imagePath.startsWith('http')) return imagePath
  
  const hostname = window.location.hostname
  const baseUrl = (hostname === 'localhost' || hostname === '127.0.0.1') 
      ? 'http://127.0.0.1:8000' 
      : 'https://api.glittr.com.br'
  
  return `${baseUrl}/storage/${imagePath}`
}

// Fecha dropdown ao clicar fora
function handleClickOutside(event) {
  if (!event.target.closest('.custom-select-wrapper')) {
    dropdownOpen.value = false
  }
}

watch(dropdownOpen, (open) => {
  if (open) {
    document.addEventListener('click', handleClickOutside)
  } else {
    document.removeEventListener('click', handleClickOutside)
  }
})
</script>

<style scoped>
.custom-select-wrapper {
  position: relative;
  margin: auto;
  width: 80%;
  max-width: 320px;
}

.custom-select {
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 10px 16px;
  cursor: pointer;
  min-height: 24px;
  display: flex;
  align-items: center;
}

.selected-option {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
}

.option-image {
  width: 32px;
  height: 32px;
  object-fit: cover;
  border-radius: 6px;
  margin-right: 8px;
}

.arrow {
  margin-left: auto;
  color: #888;
  font-size: 14px;
}

.options-list {
  position: absolute;
  top: 110%;
  left: 0;
  width: 100%;
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  z-index: 10;
  min-height: 50px;
  max-height: 220px;
  overflow-y: auto;
  padding: 0;
  margin: 0;
}

.option-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 16px;
  cursor: pointer;
  transition: background 0.2s;
}

.no-options {
  color: #929292;
  text-align: center;
  cursor: default;
  font-style: italic;
}
</style>
