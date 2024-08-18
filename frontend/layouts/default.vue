<script setup lang="js">
import Sidebar from '~/components/Sidebar.vue';
import Navbar from '~/components/Navbar.vue';
import 'primeicons/primeicons.css'

const menuItems = [
  { label: 'Home', link: '/', icon: 'pi pi-home' },
  { label: 'Show Data', link: '/Show', icon: 'pi pi-table' },
  { label: 'Add Data', link: '/Add', icon: 'pi pi-plus' },
  // Add more items as needed
];
</script>


<template>
    <Sidebar :menuItems="menuItems" />
        <div class="content">
          <Navbar />
            <slot />
        </div>
 </template>

<style scoped>
.content {
  margin-left: 250px; /* Adjust based on sidebar width */
  padding: 1rem;
}
</style>
  