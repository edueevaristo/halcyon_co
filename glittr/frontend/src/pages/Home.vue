<template>
   <div class="landing-page">

      <header class="header">
         <HeaderSection />
      </header>

      <main class="main-content">
         <section class="hero-section">
            <HeroSection />
         </section>

         <div class="search-container">
            <SearchBar />
         </div>

         <div class="category-filters">
            <CategoryFilters />
         </div>

         <section class="product-grid">
            <ProductGrid />
         </section>

         <CompareModal />

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


export default {
   name: "GlittrLandingPage",
   components: {
      HeaderSection: HeaderSectionComponent,
      CategoryFilters: CategoryFiltersComponent,
      ProductGrid: ProductGridComponent,
      HeroSection: HeroSectionComponent,
      SearchBar: SearchBarComponent,
      CompareModal: CompareModalComponent

   },
   data() {
      return {

      };
   },
};
</script>

<style scoped>
.main-content {
   display: flex;
   flex-direction: column;
   align-items: center;
   padding-left: 20px;
   padding-right: 20px;
   padding-top: 40px;
   padding-bottom: 40px;
   gap: 37px;
   margin-left: auto;
   margin-right: auto;
   width: 98vw;
}

.landing-page {
   display: flex;
   flex-direction: column;
   min-height: screen;
   width: 100%;
}

</style>