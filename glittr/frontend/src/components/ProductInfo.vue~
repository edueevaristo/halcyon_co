<template>
  <div class="main-product-info">
    <NavbarProductComponent />

    <article class="content">
      <div class="content-wrapper">
        <h4 class="return-products-list">
        <span>
          <img src="@/assets/icons/arrow-outline-left.svg" alt="Voltar" />
        </span>
          Voltar para produtos
        </h4>
      </div>

<!--      <div v-if="loading">Carregando...</div>-->
<!--      <div v-else-if="error">{{ error }}</div>-->
<!--      <ProductInfoComponent v-else :product="product" />-->
      <ProductInfoComponent />
    </article>

  </div>
</template>

<script>
import NavbarProductComponent from "@/components/NavbarProductComponent.vue";
import ProductInfoComponent from "@/components/ProductInfoComponent.vue";
import PostProductDataService from "@/services/PostProductDataService.js";

export default {
  name: 'ProductInfo',
  components: {
    NavbarProductComponent,
    ProductInfoComponent,
  },
  data() {
    return {
      product: null,
      loading: true,
      error: null,
    };
  },
  // async created() {
  //   const productId = this.$route.params.id;
  //
  //   try {
  //     const response = await PostProductDataService.getById(productId);
  //     this.product = response.data;
  //   } catch (err) {
  //     this.error = 'Erro ao carregar produto.';
  //   } finally {
  //     this.loading = false;
  //   }
  // },
};
</script>

<style scoped>

.content {
  margin-top: 3%;
}
.main-product-info {
  width: 100%;
  height: 100%;
  min-height: 100vh;
  background-color: #fff;
  background: #FFF;
}

.content-wrapper {
  display: flex;
  width: 1280px;
  max-width: 1280px;
  margin: 0 auto;
  flex-direction: column;
}

.return-products-list {
  display: flex;
  align-items: center;
  gap: 15px;
  color: #000;
  font-family: 'Poppins', sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px;
}
</style>
