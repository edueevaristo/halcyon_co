<script setup>
import HelloWorld from './components/LoginPage.vue'
</script>

<template>
  <div class="container">
    <RouterView />
  </div>
</template>












<script>
export default {
  name: 'App',
};
</script>

<style>
html, body, #app {
  height: 100%;
  margin: 0;
  padding: 0;
}


body {
  background-color: #fff;
  display: flex;
  overflow-x: hidden;
}

.container{
  display: flex;

  flex-direction: column;
  justify-content: space-between;
  margin: 0 auto;
  padding: 20px;
}

</style>
