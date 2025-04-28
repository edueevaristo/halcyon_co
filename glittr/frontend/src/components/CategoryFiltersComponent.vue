<template>
  <div class="category-filters">
    <button class="category-button active">Todas as categorias</button>
    <button class="category-button">🧴 Pele / Skincare</button>
    <button class="category-button">🧖‍♀️ Cabelos</button>
    <button class="category-button">💅 Unhas</button>
    <button class="category-button">🌸 Fragrâncias</button>
    <button class="category-button">💄 Maquiagem</button>
    <button class="category-button">🚿 Corpo e Banho</button>
    <button class="category-button">🧔 Cuidados Masculinos</button>
  </div>
</template>

<script>
export default {
  name: "CategoryFilters",
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
