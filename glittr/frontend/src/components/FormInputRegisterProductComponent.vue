<template>

  <div class="form-container">
    <form @submit.prevent="handleSubmit">

      <div class="form-group">
        <label for="product_name" class="label-name">Nome do produto*</label>
        <input type="text" id="product_name" name="product_name" class="label-input" v-model="form.product_name"
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

      <div class="form-group-category-subcategory-4-rows">

        <h6 class="product-category-information">Informações da categoria do produto</h6>

        <div class="rows-2">
          <div class="form-group-2-rows-category-information">
            <label for="type_of_coverage" class="label-name-category-information">Tipo de cobertura*</label>
            <select id="type_of_coverage" name="type_of_coverage" class="label-select" title="Tipo de cobertura"
                    v-model="form.type_of_coverage" required>
              <option value="Alta">Alta</option>
              <option value="Média">Média</option>
              <option value="Baixa">Baixa</option>
            </select>
          </div>

          <div class="form-group-2-rows-category-information">
            <label for="type_of_finish" class="label-name-category-information">Acabamento*</label>
            <select id="type_of_finish" name="type_of_finish" class="label-select" title="Tipo de acabamento"
                    v-model="form.type_of_finish" required>
              <option value="Alta">Alta</option>
              <option value="Média">Média</option>
              <option value="Baixa">Baixa</option>
            </select>
          </div>
        </div>

        <div class="rows-2">
          <div class="form-group-2-rows-category-information">
            <label for="fps" class="label-name-category-information">FPS*</label>
            <input type="text" id="fps" name="fps" class="label-input" v-model.number="form.fps" required>
          </div>

          <div class="form-group-2-rows-category-information">
            <label for="available_tones" class="label-name-category-information">Tons disponíveis (quantidade)</label>
            <input type="text" id="available_tones" name="available_tones" class="label-input"
                   v-model="form.available_tones">
          </div>
        </div>

        <div class="rows-2">
          <div class="form-group-2-rows-category-information">
            <label for="oil_free" class="label-name-category-information-oil-free">Oil-free?*</label>

            <label class="label-input-checkbox" for="oil_free">
              <input type="checkbox" id="oil_free" name="oil_free" class="hidden-checkbox" v-model="form.oil_free">
              <span class="custom-checkbox"></span>
            </label>
          </div>
        </div>

      </div>

      <div class="form-group">
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
        <label for="product_price_average" class="label-name">Preço médio</label>
        <input type="text" id="product_price_average" name="product_price_average" class="label-input"
               v-model.number="form.price_average" required>
      </div>

      <div class="form-group">
        <label for="ingredients" class="label-name">Ingredientes</label>
        <input type="text" id="ingredients" name="ingredients" class="label-input" v-model="form.ingredients" required>
      </div>

      <div class="form-group">
        <label for="link_product" class="label-name">Link para compra do produto</label>
        <input type="text" id="link_product" name="link_product" class="label-input" v-model="form.product_link"
               required>
      </div>


      <div class="form-buttons">

        <button class="cancel-button-form" @click.prevent="resetForm()">
          Cancelar cadastro
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
import PostProductDataService from "@/services/PostProductDataService.js";
import PostSubcategoryDataService from "@/services/PostSubcategoryDataService.js";
import PostCategoryDataService from "@/services/PostCategoryDataService.js";
import { showGlittrModal } from '@/stores/useSweetAlertGlittr.js';


const categories = ref([]);
const subcategories = ref([]);

const editing = ref(false);
const productId = ref(null);

const imagePreviews = ref([]);

const form = ref({
  product_name: "",
  brand: "",
  category_id: "",
  subcategory_id: "",
  type_of_coverage: "",
  type_of_finish: "",
  fps: null,
  available_tones: "",
  oil_free: false,
  price_average: null,
  ingredients: "",
  product_link: "",
  image_files: []
});


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

    form.value.oil_free = (form.value.oil_free === true || form.value.oil_free === "true") ? 1 : 0;

    const formData = new FormData();

    for (const key in form.value) {
      if (key !== "image_files") {
        formData.append(key, form.value[key]);
      }
    }

    form.value.image_files.forEach((file, index) => {
      formData.append(`image_files[]`, file);
    });

    if (editing.value) {

      await PostProductDataService.update(productId.value, formData);

      alert("Produto atualizado com sucesso!");

      showGlittrModal(  {
        icon: 'success',
        title: 'Atualização',
        text: 'Produto atualizado com sucesso!',
        confirmButtonText: 'OK',
      });

    } else {

      await PostProductDataService.insert(formData);

      showGlittrModal(  {
        icon: 'success',
        title: 'Cadastro',
        text: 'Produto cadastrado com sucesso!',
        confirmButtonText: 'OK',
      });

    }

    resetForm();

  } catch (error) {

    console.error("Erro ao salvar o produto:", error);

    showGlittrModal(  {
      icon: 'error',
      title: 'Cadastro',
      text: `Erro ao cadastrar/atualizar o produto: error ${error}`,
      confirmButtonText: 'OK',
    });

  }
};

const handleImageUpload = (event) => {

  const files = event.target.files;

  for (let i = 0; i < files.length; i++) {

    const file = files[i];
    form.value.image_files.push(file);

    const reader = new FileReader();

    reader.onload = (e) => {

      imagePreviews.value.push({
        file,
        url: e.target.result,
      });

    };

    reader.readAsDataURL(file);
  }

};

const removeImage = (index) => {

  form.value.image_files.splice(index, 1);
  imagePreviews.value.splice(index, 1);

};

const resetForm = () => {
  form.value = {
    product_name: "",
    brand: "",
    category_id: "",
    subcategory_id: "",
    type_of_coverage: "",
    type_of_finish: "",
    fps: null,
    available_tones: "",
    oil_free: false,
    price_average: null,
    ingredients: "",
    product_link: "",
    image_files: []
  };
  editing.value = false;
  productId.value = null;
  imagePreviews.value = null;

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
