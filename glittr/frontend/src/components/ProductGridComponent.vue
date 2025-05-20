<template>
  <section class="product-grid">
    <ProductCard
        v-for="product in products"
        :key="product.id"
        :id="product.id"
        :imageUrl="`http://127.0.0.1:8000${product.image_path[0].replace(/^\/storage\//, '')}`"
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
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {

        const response = await PostProductDataService.getAll();
        this.products = response.data.products;
        console.log(this.products);

      } catch (error) {
        console.error("Erro ao buscar produtos:", error);
      }
    },
  },
};
</script>

<style scoped>
.product-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 24px;
  width: 100%;
  max-width: 1248px;
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
