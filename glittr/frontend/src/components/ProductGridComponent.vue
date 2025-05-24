<template>
  <section class="product-grid">
    <div v-if="isLoading" class="loading-message">
      Carregando produtos...
    </div>
    <div v-else-if="filteredProducts.length === 0" class="no-products-message">
      Nenhum produto encontrado {{ searchTerm ? `com o termo "${searchTerm}"` : '' }}
      {{ selectedCategory ? 'nesta categoria' : '' }}.
    </div>
    <ProductCard
        v-else
        v-for="product in filteredProducts"
        :key="product.id"
        :id="product.id"
        :imageUrl="getImageUrl(product)"
        :title="product.product_name"
    />
  </section>
</template>

<script>
import ProductCardComponent from "./ProductCardComponent.vue";
import PostProductDataService from "@/services/PostProductDataService.js";

export default {
  name: "ProductGrid",
  components: {
    ProductCard: ProductCardComponent,
  },
  props: {
    selectedCategory: {
      type: Number,
      default: null
    },
    searchTerm: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      products: [],
      isLoading: false
    };
  },
  computed: {
    filteredProducts() {

      let filtered = [...this.products];

      // Filtro por categoria
      if (this.selectedCategory) {

        filtered = filtered.filter(product => {

          return (product.category?.id === this.selectedCategory) || (product.category_id === this.selectedCategory);
        });
      }

      // Filtro por termo de busca
      if (this.searchTerm) {

        const term = this.searchTerm.toLowerCase();

        filtered = filtered.filter(product => {
          return product.product_name.toLowerCase().includes(term);
        });

      }

      return filtered;
    }
  },
  methods: {
    getImageUrl(product) {
      if (!product.image_path || !product.image_path[0]) return '';

      try {

        if (product.image_path[0].includes('http')) {

          return product.image_path[0];
        }

        return `http://127.0.0.1:8000${product.image_path[0].replace(/^\/storage\//, '')}`;

      } catch (error) {

        console.error("Erro ao processar imagem:", error);
        return '';

      }
    },
    async fetchProducts() {

      this.isLoading = true;

      try {

        const response = await PostProductDataService.getAll();
        this.products = response.data.products || [];

        console.log("Produtos carregados:", this.products);

      } catch (error) {

        console.error("Erro ao buscar produtos:", error);
        this.products = [];

      } finally {

        this.isLoading = false;
      }
    }
  },
  mounted() {
    this.fetchProducts();
  }
};
</script>

<style scoped>
.product-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 24px;
  width: 100%;
  max-width: 1248px;
  min-height: 300px;
}

.loading-message,
.no-products-message {
  grid-column: 1 / -1;
  text-align: center;
  padding: 40px;
  font-size: 18px;
  color: #757575;
}

@media (max-width: 991px) {
  .product-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 640px) {
  .product-grid {
    grid-template-columns: repeat(1, minmax(0, 1fr));
  }
}
</style>