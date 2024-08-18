<template>
  <h1>Dashboard</h1>
  <p>
    Use Sidebar to navigate to other pages.
</p>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: 'auth'
})
useHead({
  titleTemplate: "%s - Dashboard",
});


</script>