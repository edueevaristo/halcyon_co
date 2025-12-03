<template>
  <div class="form-group-category-subcategory-4-rows" v-if="attributes.length">
    <h6 class="product-category-information">Informações da categoria do produto</h6>

    <div v-if="loading" class="loading-message">Carregando atributos...</div>
    <div v-else-if="error" class="error-message">Erro ao carregar atributos.</div>

    <template v-else>
      <div class="rows-2" v-for="(group, index) in groupedAttributes" :key="'group-' + index">
        <div v-for="attribute in group" :key="attribute.id" class="form-group-2-rows-category-information">
          <label :for="'attribute-' + attribute.id" class="label-name-category-information">
            {{ attribute.name }}
            <span v-if="attribute.required" class="required-field">*</span>
          </label>

          <select v-if="attribute.type === 'select'"
                  :id="'attribute-' + attribute.id"
                  class="label-select"
                  v-model="form[attribute.name]"
                  :required="attribute.required">
            <option value="">Selecione</option>
            <option v-for="option in selectOptions[attribute.name] || []"
                    :key="option.id"
                    :value="option.value">
              {{ option.value }}
            </option>
          </select>

          <label v-else-if="attribute.type === 'boolean'"
                 class="label-input-checkbox"
                 :for="'attribute-' + attribute.id">
            <input type="checkbox"
                   :id="'attribute-' + attribute.id"
                   class="hidden-checkbox"
                   v-model="form[attribute.name]"
                   :required="attribute.required"/>
            <span class="custom-checkbox"></span>
          </label>

          <input v-else-if="attribute.type === 'text'"
                 type="text"
                 :id="'attribute-' + attribute.id"
                 class="label-input"
                 v-model="form[attribute.name]"
                 :required="attribute.required"/>

          <input v-else-if="attribute.type === 'integer' || attribute.type === 'float'"
                 type="number"
                 :id="'attribute-' + attribute.id"
                 class="label-input"
                 v-model.number="form[attribute.name]"
                 :step="attribute.type === 'float' ? '0.01' : '1'"
                 :required="attribute.required"/>
        </div>
      </div>
    </template>
  </div>
</template>

<script setup>
import {ref, computed, watch} from 'vue'
import PostAttributesDataService from "@/services/PostAttributesDataService.js";

const props = defineProps({
  subcategoryId: {
    type: Number,
    required: true
  },
  modelValue: {
    type: Array,
    default: () => ([])
  }
});

const emit = defineEmits(['update:modelValue']);

const attributes = ref([]);
const selectOptions = ref({});
const form = ref({});
const loading = ref(false);
const error = ref(null);

watch(form, () => {

  const formattedAttributes = [];

  Object.keys(form.value).forEach(key => {

    if (form.value[key] !== '' && form.value[key] !== null && form.value[key] !== undefined) {

      formattedAttributes.push({
        name: key,
        value: form.value[key]
      });

    }

  });
  emit('update:modelValue', formattedAttributes);
}, {deep: true});

const loadAttributes = async () => {
  if (!props.subcategoryId) {
    resetAttributes();
    return;
  }

  try {
    loading.value = true;
    error.value = null;
    const {data} = await PostAttributesDataService.getBySubCategory(props.subcategoryId);
    attributes.value = data;
    await initializeFormAndOptions(data);
  } catch (err) {
    console.error('Erro ao carregar atributos:', err);
    error.value = err;
    resetAttributes();
  } finally {
    loading.value = false;
  }
};

const initializeFormAndOptions = async (attributesData) => {
  const newForm = {};
  const newSelectOptions = {};

  // Converter modelValue (array) para objeto para facilitar o acesso
  const modelValueObj = {};
  if (Array.isArray(props.modelValue)) {
    props.modelValue.forEach(attr => {
      modelValueObj[attr.name] = attr.value;
    });
  }

  const selectPromises = attributesData
      .filter(attr => attr.type === 'select')
      .map(async attr => {
        try {
          const res = await PostAttributesDataService.getValuesById(attr.id);
          newSelectOptions[attr.name] = res.data;
        } catch (err) {
          console.error(`Erro ao carregar opções para ${attr.name}:`, err);
          newSelectOptions[attr.name] = [];
        }
      });

  attributesData.forEach(attr => {
    newForm[attr.name] = modelValueObj[attr.name] ?? getDefaultValue(attr);
  });

  await Promise.all(selectPromises);
  selectOptions.value = newSelectOptions;
  form.value = newForm;
};

const getDefaultValue = (attribute) => {
  switch (attribute.type) {
    case 'boolean':
      return false;
    case 'integer':
    case 'float':
      return 0;
    default:
      return '';
  }
};

const resetAttributes = () => {
  attributes.value = [];
  selectOptions.value = {};
  form.value = {};
};

const groupedAttributes = computed(() => {
  const groups = [];
  for (let i = 0; i < attributes.value.length; i += 2) {
    groups.push(attributes.value.slice(i, i + 2));
  }
  return groups;
});

watch(() => props.subcategoryId, loadAttributes);
</script>


<style scoped>

input,
textarea,
select {
  color: #000 !important;
}

.loading-message, .error-message {
  color: #666;
  font-family: 'Poppins', sans-serif;
  padding: 10px;
}

.error-message {
  color: #d9534f;
}

.required-field {
  color: #d9534f;
  margin-left: 4px;
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
