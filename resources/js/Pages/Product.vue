<template>
    <div class="home-page">
      <AppHeader />
      <AppProduct1 />
      <AppFooter />
    </div>
  </template>
  
  <script setup>
  import AppHeader from './Header.vue';
  import AppProduct1 from './Product1.vue';
  import AppFooter from './Footer.vue';
  </script>
  
  <script>
  export default {
    name: 'AppProduct'
  }
  </script>
  
  <style scoped>
  .home-page{
    background-color: #884535;
  }
  </style>