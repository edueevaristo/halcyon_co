<template>
  <div class="search-container">
    <div v-html="searchIcon"></div>
    <input
        type="text"
        v-model="searchInput"
        @input="onSearchInput"
        placeholder="O que você quer comparar hoje?"
        class="search-input"
        aria-label="Buscar produtos"
    />
  </div>
</template>

<script>
import {debounce} from 'lodash';

export default {
  name: "SearchBar",
  data() {
    return {
      searchInput: '',
      searchIcon: `<svg id="112:689" layer-name="material-symbols:search" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[24px] h-[24px]">
<path d="M20.1 21L13.8 14.7C13.3 15.1 12.725 15.4167 12.075 15.65C11.425 15.8833 10.7333 16 10 16C8.18333 16 6.646 15.3707 5.388 14.112C4.13 12.8533 3.50067 11.316 3.5 9.5C3.49933 7.684 4.12867 6.14667 5.388 4.888C6.64733 3.62933 8.18467 3 10 3C11.8153 3 13.353 3.62933 14.613 4.888C15.873 6.14667 16.502 7.684 16.5 9.5C16.5 10.2333 16.3833 10.925 16.15 11.575C15.9167 12.225 15.6 12.8 15.2 13.3L21.5 19.6L20.1 21ZM10 14C11.25 14 12.3127 13.5627 13.188 12.688C14.0633 11.8133 14.5007 10.7507 14.5 9.5C14.4993 8.24933 14.062 7.187 13.188 6.313C12.314 5.439 11.2513 5.00133 10 5C8.74867 4.99867 7.68633 5.43633 6.813 6.313C5.93967 7.18967 5.502 8.252 5.5 9.5C5.498 10.748 5.93567 11.8107 6.813 12.688C7.69033 13.5653 8.75267 14.0027 10 14Z" fill="#B33974"></path>
</svg>`
    };
  },
  methods: {
    onSearchInput: debounce(function () {
      this.$emit('search', this.searchInput.trim());
    }, 300)
  }
};
</script>

<style scoped>
.search-container {
  display: flex;
  width: 900px;
  max-width: 1500px;
  padding: 16px 30px;
  align-items: center;
  gap: 12px;
  border-radius: 30px;
  border: 1px solid #9400ef;
  transition: all 0.3s ease;
  background: white;
  margin: 0 auto;
}

.search-container:focus-within {
  border-color: #B33974;
  box-shadow: 0 0 0 3px rgba(179, 57, 116, 0.1);
}

.search-input {
  flex: 1;
  color: #333;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  font-weight: 400;
  line-height: 1.5;
  border: none;
  outline: none;
  background: transparent;
  min-width: 0;
}

.search-input::placeholder {
  color: #BDBDBD;
  opacity: 1;
}

@media (max-width: 768px) {
  .search-container {
    padding: 10px 20px;
    max-width: 100%;
  }
}
</style>