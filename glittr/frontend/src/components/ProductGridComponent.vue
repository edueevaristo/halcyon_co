<template>
  <div class="product-grid-container">
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
          :likesCount="product.likes_count || 0"
          :reviewsCount="product.reviews_count || 0"

      />
    </section>
    
    <!-- Paginação -->
    <div v-if="!searchTerm && !selectedCategory && lastPage > 1" class="pagination">
      <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1" class="pagination-btn">
        Anterior
      </button>
      
      <span class="pagination-info">
        Página {{ currentPage }} de {{ lastPage }} ({{ total }} produtos)
      </span>
      
      <button @click="changePage(currentPage + 1)" :disabled="currentPage === lastPage" class="pagination-btn">
        Próxima
      </button>
    </div>
  </div>
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
      isLoading: false,
      currentPage: 1,
      lastPage: 1,
      perPage: 12,
      total: 0
    };
  },
  computed: {
    filteredProducts() {
      let filtered = [...this.products];
      if (this.selectedCategory) {
        filtered = filtered.filter(product => {
          return (product.category?.id === this.selectedCategory) || (product.category_id === this.selectedCategory);
        });
      }
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
      if (!product.image_path || !Array.isArray(product.image_path) || !product.image_path[0]) {
        return '';
      }
      try {
        const imagePath = product.image_path[0];
        if (imagePath.includes('http')) {
          return imagePath;
        }
        const hostname = window.location.hostname;
        const baseUrl = (hostname === 'localhost' || hostname === '127.0.0.1') 
            ? 'http://127.0.0.1:8000' 
            : 'https://halcyon-co.onrender.com';
        const cleanPath = imagePath.replace(/^\/storage\//, '');
        return `${baseUrl}/storage/${cleanPath}`;
      } catch (error) {
        console.error("Erro ao processar imagem:", error);
        return '';
      }
    },
    async fetchProducts(page = 1) {
      this.isLoading = true;
      try {
        const response = await PostProductDataService.getAll(page, this.perPage);
        this.products = response.data.data || response.data.products || [];
        this.currentPage = response.data.current_page || 1;
        this.lastPage = response.data.last_page || 1;
        this.total = response.data.total || 0;
      } catch (error) {
        console.error("Erro ao buscar produtos:", error);
        this.products = [];
      } finally {
        this.isLoading = false;
      }
    },
    
    async changePage(page) {
      if (page >= 1 && page <= this.lastPage) {
        await this.fetchProducts(page);
      }
    }
  },
  mounted() {
    this.fetchProducts();
    window.addEventListener('product-updated', this.fetchProducts);
  },
  beforeUnmount() {
    window.removeEventListener('product-updated', this.fetchProducts);
  }
};
</script>

<style scoped>
.product-grid-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 24px;
  width: 100%;
}

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

.pagination {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-top: 20px;
}

.pagination-btn {
  padding: 8px 16px;
  background: linear-gradient(90deg, #ED008C 0%, #E10CFF 100%);
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  transition: opacity 0.2s;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-info {
  color: #757575;
  font-size: 14px;
  font-family: 'Poppins', sans-serif;
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
  
  .pagination {
    flex-direction: column;
    gap: 12px;
  }
}
</style>