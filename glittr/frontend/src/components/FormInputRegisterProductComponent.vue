<template>

  <div class="form-container">
    <form action="">

      <div class="form-group">
        <label for="product_name" class="label-name">Nome do produto*</label>
        <input type="text" id="product_name" name="product_name" class="label-input" required>
      </div>

      <div class="form-group">
        <label for="product_brand" class="label-name">Marca*</label>
        <input type="text" id="product_brand" name="product_brand" class="label-input" required>
      </div>

      <div class="rows-2">

        <div class="form-group-category">
          <label for="product_category" class="label-name">Categoria*</label>
          <select id="product_category" name="product_category" class="label-select" title="Categoria" required>
            <option value="">Teste 1</option>
            <option value="">Teste 1</option>
            <option value="">Teste 1</option>
          </select>
        </div>

        <div class="form-group-subcategory">
          <label for="product_subcategory" class="label-name">Subcategoria*</label>
          <select id="product_subcategory" name="product_subcategory" class="label-select" title="Subcategoria" required>
            <option value="">Teste 1</option>
            <option value="">Teste 1</option>
            <option value="">Teste 1</option>
          </select>
        </div>
      </div>

      <div class="form-group-category-subcategory-4-rows">

        <h6 class="product-category-information">Informações da categoria do produto</h6>

        <div class="rows-2">
          <div class="form-group-2-rows-category-information">
            <label for="type_of_coverage" class="label-name-category-information">Tipo de cobertura*</label>
            <select id="type_of_coverage" name="type_of_coverage" class="label-select" title="Tipo de cobertura" required>
              <option value="">Alta</option>
              <option value="">Média</option>
              <option value="">Baixa</option>
            </select>
          </div>

          <div class="form-group-2-rows-category-information">
            <label for="type_of_finish" class="label-name-category-information">Acabamento*</label>
            <select id="type_of_finish" name="type_of_finish" class="label-select" title="Tipo de acabamento" required>
              <option value="">Alta</option>
              <option value="">Média</option>
              <option value="">Baixa</option>
            </select>
          </div>
        </div>

        <div class="rows-2">
          <div class="form-group-2-rows-category-information">
            <label for="fps" class="label-name-category-information">FPS*</label>
            <input type="text" id="fps" name="fps" class="label-input">
          </div>

          <div class="form-group-2-rows-category-information">
            <label for="available_tones" class="label-name-category-information">Tons disponíveis (quantidade)</label>
            <input type="text" id="available_tones" name="available_tones" class="label-input">
          </div>
        </div>

        <div class="rows-2">
          <div class="form-group-2-rows-category-information">
            <label for="oil_free" class="label-name-category-information-oil-free">Oil-free?*</label>

            <label class="label-input-checkbox" for="oil_free">
              <input type="checkbox" id="oil_free" name="oil_free" class="hidden-checkbox">
              <span class="custom-checkbox"></span>
            </label>
          </div>
        </div>

        </div>

        <div class="form-group">
          <label for="product_name" class="label-name">Imagens do produto*</label>

          <label class="upload-area">
            <input type="file" accept="image/*" class="upload-input" />
            <img src="@/assets/icons/upload.svg" alt="Icone de upload">
            <span class="upload-text">Arraste um arquivo ou procure no seu dispositivo</span>
          </label>
        </div>

        <h6 class="product-category-information-optional">Informações opcionais</h6>

        <div class="form-group">
          <label for="product_price_average" class="label-name">Preço médio</label>
          <input type="text" id="product_price_average" name="product_price_average" class="label-input" required>
        </div>

        <div class="form-group">
          <label for="ingredients" class="label-name">Ingredientes</label>
          <input type="text" id="ingredients" name="ingredients" class="label-input" required>
        </div>

        <div class="form-group">
          <label for="link_product" class="label-name">Link para compra do produto</label>
          <input type="text" id="link_product" name="link_product" class="label-input" required>
        </div>


        <div class="form-buttons">

          <button class="cancel-button-form">
            Cancelar cadastro
          </button>

          <button class="post-button-form">
            <span class="post-button-icon"><img src="@/assets/icons/saved.svg"></span>Cadastrar produto
          </button>

        </div>


    </form>
  </div>

</template>

<style scoped>
/**INPUTS **/
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


</style>
<script setup>
</script>