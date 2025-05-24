<template>
  <div class="category-filters">
    <button
        class="category-button"
        :class="{ active: selectedCategory === null }"
        @click="selectCategory(null)"
    >
      Todas as categorias
    </button>
    <button
        v-for="category in categories"
        :key="category.id"
        class="category-button"
        :title="category.name"
        :data-emoji="category.emoji"
        :data-id="category.id"
        :id="category.id"
        :class="{ active: selectedCategory === category.id }"
        @click="selectCategory(category.id)"
    >
      {{ category.emoji }} {{ category.name }}
    </button>
  </div>
</template>

<script>
import PostCategoryDataService from "@/services/PostCategoryDataService.js";

export default {
  name: "CategoryFilters",
  data() {
    return {
      categories: [],
      selectedCategory: null
    };
  },
  methods: {
    retrieveCategories() {
      PostCategoryDataService.getAll()
          .then((response) => {
            this.categories = response.data;
          })
          .catch((e) => {
            console.error("Erro ao carregar categorias:", e);
          });
    },
    selectCategory(categoryId) {
      this.selectedCategory = categoryId;
      this.$emit('category-selected', categoryId);
    }
  },
  mounted() {
    this.retrieveCategories();
  }
};

</script>
<style scoped>
.category-filters {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
  width: 100%;
  max-width: 1248px;
}

.category-button {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  padding: 5px 10px;
  border-radius: 30px;
  border-width: 1px;
  border-color: #757575;
  background-color: #fff;
  color: #757575;
  cursor: pointer;
}

.category-button.active {
  color: #fff;
  background-color: #141414;
}
</style>
