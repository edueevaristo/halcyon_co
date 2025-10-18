<script setup>
</script>

<template>
  <RouterView/>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
html {
  overflow-x: hidden;
  width: 100%;
}

body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  width: 100%;
  max-width: 100vw;
  box-sizing: border-box;
}

* {
  box-sizing: border-box;
}

#app {
  width: 100%;
  max-width: 100vw;
  min-height: 100vh;
  overflow-x: hidden;
}

/* Previne overflow horizontal em todos os elementos */
* {
  max-width: 100%;
}

/* Corrige problemas específicos de width */
.header,
.main-product,
.product-grid,
.modal-overlay {
  max-width: 100vw;
  overflow-x: hidden;
}

.glittr-modal {
  border-radius: 20px !important;
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.6) !important;
}

.glittr-confirm {
  background: #ff4b91 !important;
  color: white !important;
  border-radius: 12px !important;
  padding: 10px 20px !important;
  font-weight: bold !important;
}

.glittr-cancel {
  background: transparent !important;
  border: 1px solid #999 !important;
  color: #ccc !important;
  border-radius: 12px !important;
  padding: 10px 20px !important;
}

.glittr-gradient-text {
  background: linear-gradient(90deg, #ff4b91, #6c5ce7);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: bold;
}


</style>