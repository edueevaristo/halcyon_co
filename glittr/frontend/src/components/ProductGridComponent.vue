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
          :isPremiumRequired="product.premium_required || false"
          :userIsPremium="userIsPremium"
      />
    </section>
    
    <!-- Mensagem para usuários não premium -->
    <div v-if="hasMoreProducts && !userIsPremium" class="premium-message">
      <div class="premium-content">
        <span class="premium-icon">🔒</span>
        <p>Há mais produtos nesta categoria, para obter a listagem completa, terá que ter um usuário premium</p>
        <small>Mostrando 10 de {{ actualTotal }} produtos</small>
      </div>
    </div>
    
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
      total: 0,
      userIsPremium: false,
      hasMoreProducts: false,
      actualTotal: 0
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
            : 'https://api.glittr.com.br';
        return `${baseUrl}${imagePath}`;
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
        this.userIsPremium = response.data.user_is_premium || false;
        this.hasMoreProducts = response.data.has_more_products || false;
        this.actualTotal = response.data.actual_total || this.total;
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

.pagination-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(237, 0, 140, 0.4);
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

.premium-message {
  background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
  border: 2px solid #f39c12;
  border-radius: 12px;
  padding: 20px;
  margin: 20px 0;
  text-align: center;
}

.premium-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}

.premium-icon {
  font-size: 24px;
}

.premium-message p {
  color: #856404;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 500;
  margin: 0;
  line-height: 1.4;
}

.premium-message small {
  color: #6c5ce7;
  font-family: 'Poppins', sans-serif;
  font-size: 12px;
  font-weight: 400;
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