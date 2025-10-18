<template>
  <div class="landing-page">
    <header class="header">
      <HeaderSection/>
    </header>

    <main class="main-content">
      <section class="hero-section">
        <HeroSection/>
      </section>

      <div class="search-container">
        <SearchBar @search="handleSearch"/>
      </div>

      <div class="category-filters">
        <CategoryFilters @category-selected="handleCategorySelected"/>
      </div>

      <section class="product-grid">
        <ProductGrid :selectedCategory="currentCategory"
                     :searchTerm="searchTerm"
        />
      </section>

      <CompareModal/>
    </main>
  </div>
</template>

<script>
import HeaderSectionComponent from '../components/HeaderSectionComponent.vue';
import CategoryFiltersComponent from '../components/CategoryFiltersComponent.vue';
import ProductGridComponent from '../components/ProductGridComponent.vue';
import HeroSectionComponent from '../components/HeroSectionComponent.vue';
import SearchBarComponent from '../components/SearchBarComponent.vue';
import CompareModalComponent from '../components/CompareModalComponent.vue';
import RegisterProductsModalComponent from '../components/RegisterProductsModalComponent.vue';

export default {
  name: "GlittrLandingPage",
  components: {
    HeaderSection: HeaderSectionComponent,
    CategoryFilters: CategoryFiltersComponent,
    ProductGrid: ProductGridComponent,
    HeroSection: HeroSectionComponent,
    SearchBar: SearchBarComponent,
    CompareModal: CompareModalComponent,
    AddProduct: RegisterProductsModalComponent
  },
  data() {
    return {
      currentCategory: null,
      searchTerm: '' // Adicione esta linha
    };
  },
  methods: {
    handleCategorySelected(categoryId) {

      this.currentCategory = categoryId;
      this.searchTerm = '';
    },
    handleSearch(term) {
      this.searchTerm = term.toLowerCase().trim();
    }
  }
};
</script>

<style scoped>
.main-content {
  background-color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 40px 20px;
  gap: 37px;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
}

.landing-page {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  width: 100%;
}
</style>