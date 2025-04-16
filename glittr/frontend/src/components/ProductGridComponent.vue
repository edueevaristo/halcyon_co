<template>
  <section class="product-grid">
    <ProductCard
      v-for="product in products"
      :key="product.id"
      :id="product.id"
      :imageUrl="product.imageUrl"
      :title="product.title"
    />
  </section>
</template>

<script>
import ProductCardComponent from "./ProductCardComponent.vue";

export default {
  name: "ProductGrid",
  components: {
    ProductCard: ProductCardComponent,
  },
  data() {
    return {
      products: [
        {
          id: 1,
          imageUrl:
            "https://cdn.builder.io/api/v1/image/assets/TEMP/1c87f2d0143f3f38e2659cb04530d8648daecaef",
          title: "Hidratante Facial Glow Up",
        },
      ],
    };
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
