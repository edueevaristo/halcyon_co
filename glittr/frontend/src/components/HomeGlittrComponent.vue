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
import HeaderSection from '../components/HeaderSection.vue';
import CategoryFilters from '../components/CategoryFilters.vue';
import ProductGrid from '../components/ProductGrid.vue';
import HeroSection from '../components/HeroSection.vue';
import SearchBar from '../components/SearchBar.vue';
import CompareModal from './CompareModal.vue';


export default {
   name: "GlittrLandingPage",
   components: {
      HeaderSection,
      CategoryFilters,
      ProductGrid,
      HeroSection,
      SearchBar,
      CompareModal

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