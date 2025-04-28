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
html,
body,
#app {
  height: 100%;
  margin: 0;
  padding: 0;
}


body {
  display: flex;
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