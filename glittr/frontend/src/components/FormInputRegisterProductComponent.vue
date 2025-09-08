<template>
  <div class="form-container">
    <form @submit.prevent="handleSubmit">

      <div class="form-group">
        <label for="product_name" class="label-name">Nome do produto*</label>
        <input type="text" id="product_name" name="product_name" class="label-input" v-model="form.product_name"
               required>
      </div>

      <div class="form-group">
        <label for="description" class="label-name">Descrição do produto*</label>
        <input type="text" id="description" name="description" class="label-input" v-model="form.description"
               required>
      </div>

      <div class="form-group">
        <label for="product_brand" class="label-name">Marca*</label>
        <input type="text" id="product_brand" name="product_brand" class="label-input" v-model="form.brand" required>
      </div>

      <div class="rows-2">
        <div class="form-group-category">
          <label for="product_category" class="label-name">Categoria*</label>
          <select
              id="product_category"
              name="product_category"
              class="label-select"
              title="Categoria"
              required
              v-model="form.category_id"
          >
            <option disabled value="">Selecione uma categoria</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>

        <div class="form-group-subcategory">
          <label for="product_subcategory" class="label-name">Subcategoria*</label>
          <select
              id="product_subcategory"
              name="product_subcategory"
              class="label-select"
              title="Subcategoria"
              required
              v-model="form.subcategory_id"
              :disabled="!form.category_id"
          >
            <option disabled value="">Selecione uma subcategoria</option>
            <option
                v-for="subcategory in subcategories"
                :key="subcategory.id"
                :value="subcategory.id"
            >
              {{ subcategory.name }}
            </option>
          </select>
        </div>
      </div>

      <DynamicAttributes
          :subcategory-id="form.subcategory_id"
          :model-value="form.attributes"
          @update:model-value="updateAttributes"
      />

      <div class="form-group" style="margin-top: 50px">
        <label class="label-name">Imagens do produto*</label>
        <label class="upload-area">
          <input
              type="file"
              accept="image/*"
              class="upload-input"
              multiple
              @change="handleImageUpload"
          />
          <img src="@/assets/icons/upload.svg" alt="Icone de upload">
          <span class="upload-text">Arraste ou selecione imagens</span>
        </label>
        <div class="image-preview-container">
          <div
              v-for="(image, index) in imagePreviews"
              :key="index"
              class="image-preview"
          >
            <img :src="image.url" alt="Preview" class="preview-img"/>
            <button type="button" class="remove-btn" @click="removeImage(index)">X</button>
          </div>
        </div>
      </div>

      <h6 class="product-category-information-optional">Informações opcionais</h6>

      <div class="form-group">
        <label for="product_price_average" class="label-name">Preço médio (R$)</label>
        <input type="number" id="product_price_average" name="product_price_average" class="label-input"
               v-model.number="form.price_average">
      </div>

      <div class="form-group">
        <label for="ingredients" class="label-name">Ingredientes</label>
        <input type="text" id="ingredients" name="ingredients" class="label-input" v-model="form.ingredients">
      </div>

      <div class="form-group">
        <label for="link_product" class="label-name">Link para compra do produto</label>
        <input type="text" id="link_product" name="link_product" class="label-input" v-model="form.product_link">
      </div>

      <div class="form-buttons">
        <button class="cancel-button-form" @click.prevent="resetForm()">
          Limpar campos
        </button>
        <button class="post-button-form" type="submit">
          <span class="post-button-icon"><img src="@/assets/icons/saved.svg" alt="Icone de salvar"></span>Cadastrar
          produto
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>

import {ref, onMounted, watch} from "vue";
import DynamicAttributes from "@/components/DynamicAttributesComponent.vue";
import PostProductDataService from "@/services/PostProductDataService.js";
import PostSubcategoryDataService from "@/services/PostSubcategoryDataService.js";
import PostCategoryDataService from "@/services/PostCategoryDataService.js";
import Swal from 'sweetalert2';
import {showGlittrModal} from '@/stores/useSweetAlertGlittr.js';

const categories = ref([]);
const subcategories = ref([]);
const editing = ref(false);
const productId = ref(null);
const imagePreviews = ref([]);
const emit = defineEmits(['product-updated', 'close-modal']);

const form = ref({
  product_name: "",
  description: "",
  brand: "",
  category_id: "",
  subcategory_id: "",
  attributes: [],
  price_average: null,
  ingredients: "",
  product_link: "",
  image_files: []
});

const updateAttributes = (attributes) => {
  const formattedAttributes = [];
  Object.keys(attributes).forEach(key => {
    if (attributes[key] !== '' && attributes[key] !== null && attributes[key] !== undefined) {
      formattedAttributes.push({
        name: key.trim(),
        value: attributes[key]
      });
    }
  });
  form.value.attributes = formattedAttributes;
};


onMounted(async () => {
  try {
    const response = await PostCategoryDataService.getAll();
    categories.value = response.data;
  } catch (error) {
    console.error("Erro ao buscar categorias:", error);
  }
});

watch(() => form.value.category_id, async (categoryId) => {
  form.value.subcategory_id = "";
  if (categoryId) {
    try {
      const response = await PostSubcategoryDataService.getAll();
      subcategories.value = response.data.filter(
          (sub) => sub.category_id === categoryId
      );
    } catch (error) {
      console.error("Erro ao buscar subcategorias:", error);
    }
  } else {
    subcategories.value = [];
  }
});

const handleSubmit = async () => {
  try {
    const formData = new FormData();

    const basicFields = [
      'product_name', 'description', 'brand', 'category_id', 'subcategory_id',
      'price_average', 'ingredients', 'product_link'
    ];

    basicFields.forEach(field => {
      formData.append(field, form.value[field] ?? '');
    });

    if (form.value.attributes && form.value.attributes.length > 0) {
      formData.append('attributes', JSON.stringify(form.value.attributes));
    }

    if (form.value.image_files?.length > 0) {
      form.value.image_files.forEach((file, index) => {
        formData.append(`image_files[${index}]`, file);
      });
    }

    console.log('Dados do formulário:');
    for (let [key, value] of formData.entries()) {
      console.log(key, value);
    }

    const apiCall = editing.value
        ? () => PostProductDataService.update(productId.value, formData)
        : () => PostProductDataService.insert(formData);

    const response = await apiCall();

    await showGlittrModal({
      icon: 'success',
      title: editing.value ? 'Obrigad@!' : 'Obrigad@!',
      text: `Você arrasou! ✨
              Cada produto adicionado deixa a Glittr ainda mais completa e ajuda outras pessoas a encontrarem o match perfeito.
              A gente vai dar uma olhadinha e, se estiver tudo certo, logo ele aparece por aqui. Enquanto isso, bora brilhar? 🌟`,
      confirmButtonText: 'Continuar navegando'
    });

    resetForm();
    emit('product-updated');
    emit('close-modal');

  } catch (error) {
    console.error('Erro ao salvar produto:', error);
    let errorMessage = 'Erro ao processar o produto';

    if (error.response) {
      if (error.response.data?.message) {
        errorMessage = error.response.data.message;
      } else if (error.response.status === 500) {
        errorMessage = 'Erro interno no servidor';
      }
    } else if (error.message) {
      errorMessage = error.message;
    }

    await showGlittrModal({
      icon: 'error',
      title: 'Erro',
      text: errorMessage,
      confirmButtonText: 'OK'
    });
  }
};

const handleImageUpload = (event) => {

  const files = Array.from(event.target.files);
  event.target.value = '';

  files.forEach(file => {

    if (!file.type.match('image.*')) {

      showGlittrModal({
        icon: 'error',
        title: 'Arquivo inválido',
        text: `O arquivo ${file.name} não é uma imagem válida.`,
        confirmButtonText: 'OK'
      });

      return;

    }

    if (file.size > 5 * 1024 * 1024) {

      showGlittrModal({
        icon: 'error',
        title: 'Arquivo muito grande',
        text: `A imagem ${file.name} excede o tamanho máximo de 5MB.`,
        confirmButtonText: 'OK'
      });

      return;

    }

    form.value.image_files.push(file);

    const reader = new FileReader();

    reader.onload = (e) => {

      imagePreviews.value.push({
        file,
        url: e.target.result
      });

    };

    reader.readAsDataURL(file);

  });

};

const removeImage = (index) => {

  if (index >= 0 && index < imagePreviews.value.length) {

    imagePreviews.value.splice(index, 1);
    form.value.image_files.splice(index, 1);

  } else {

    console.error(`Índice de imagem inválido: ${index}`);
  }

};

const resetForm = () => {
  form.value = {
    product_name: "",
    description: "",
    brand: "",
    category_id: "",
    subcategory_id: "",
    attributes: {},
    price_average: null,
    ingredients: "",
    product_link: "",
    image_files: []
  };

  imagePreviews.value = [];
  editing.value = false;
  productId.value = null;
  emit('reset-attributes');
};


</script>

<style scoped>
/**INPUTS **/

input,
textarea,
select {
  color: #000 !important;
}

.form-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 15px;
  align-self: stretch;
  margin-top: 20px;
}

.label-name {
  align-self: stretch;
  color: #ED008C;
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px;
}

.label-input {
  height: 45px;
  align-self: stretch;
  border-radius: 10px;
  border: 1px solid #757575;
  background: #FFF;
}

.form-group-2-rows {
  display: flex;
  height: 80px;
  justify-content: space-between;
  align-items: flex-start;
  align-self: stretch;
}

.form-group-category {
  display: flex;
  width: 50%;
  flex-direction: column;
  align-items: flex-start;
  gap: 15px;
  margin-top: 30px;
}

.form-group-subcategory {
  display: flex;
  width: 50%;
  flex-direction: column;
  align-items: flex-start;
  gap: 15px;
  margin-top: 30px;
}

.label-select {
  display: flex;
  height: 45px;
  padding: 10px;
  justify-content: space-between;
  align-items: center;
  align-self: stretch;
  border-radius: 10px;
  border: 1px solid #757575;
  background: #FFF;
}

.form-group-category-subcategory-4-rows {
  display: flex;
  padding: 15px;
  flex-direction: column;
  align-items: flex-start;
  gap: 30px;
  align-self: stretch;
}

.product-category-information {
  width: 100%;
  color: #B0B0B0;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px;
  margin-bottom: 3px;
  margin-top: 60px;
}

.form-group-2-rows-category-information {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 15px;
  flex: 1 0 0;
}

.label-name-category-information {
  color: #B33974;
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px;
  align-self: stretch;
}

.rows-2 {
  display: flex;
  height: 80px;
  align-items: flex-start;
  gap: 30px;
  align-self: stretch;
}

.label-name-category-information-oil-free {
  color: #B33974;
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px;
  align-self: stretch;
}

.label-input-checkbox {
  display: flex;
  width: 41px;
  height: 31px;
  padding: 2px 2px 2px 22px;
  justify-content: flex-end;
  align-items: center;
  border-radius: 100px;
  background: #B33974;
  cursor: pointer;
  position: relative;
}

/* Esconde o input nativo */
.hidden-checkbox {
  display: none;
}

/* Estiliza a bolinha */
.custom-checkbox {
  width: 26px;
  height: 26px;
  background: white;
  border-radius: 50%;
  position: absolute;
  left: 2px;
  top: 50%;
  transform: translateY(-50%);
  transition: left 0.3s ease;
}

/* Quando marcado, move a bolinha */
.hidden-checkbox:checked + .custom-checkbox {
  left: calc(100% - 28px);
}

.upload-area {
  display: flex;
  padding: 50px 113px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 10px;
  align-self: stretch;
  border-radius: 10px;
  border: 1px solid #757575;
  background: #FFF;
  cursor: pointer;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.upload-input {
  opacity: 0;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  cursor: pointer;
}

.upload-text {
  color: #757575;
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px;
}

.product-category-information-optional {
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
  margin-bottom: 2px;
  margin-top: 35px;
}

.form-buttons {
  display: flex;
  justify-content: flex-end;
  align-items: flex-start;
  gap: 10px;
  align-self: stretch;
  margin-top: 30px;
  margin-bottom: 20px;
}

.cancel-button-form {
  display: flex;
  height: 44px;
  padding: 10px;
  align-items: center;
  gap: 15px;
  border-radius: 10px;
  background: #D9D9D9;
  color: #757575;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%;
}

.post-button-form {
  display: flex;
  height: 44px;
  padding: 10px;
  align-items: center;
  gap: 15px;
  border-radius: 10px;
  background: linear-gradient(90deg, #ED008C 0%, #FA90AB 100%);
  color: #FFF;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}

.post-button-icon {
  width: 20px;
  height: 20px;
  aspect-ratio: 1/1;
}

.image-preview-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 10px;
}

.image-preview {
  position: relative;
  width: 100px;
  height: 100px;
}

.preview-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 6px;
  border: 1px solid #ccc;
}

.remove-btn {
  position: absolute;
  top: 8px;
  right: 3px;
  background: #f44336;
  border: none;
  color: white;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  font-weight: bold;
  cursor: pointer;
  font-size: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
}


</style>
