<script setup lang="js">
import '~/assets/css/sidebar.css';
import { useToast } from "primevue/usetoast";

const props = defineProps({
  menuItems: {
    type: Array,
    required: true,
  },
});

const toast = useToast;

const onLogout = async () => await handleLogout(toast)
</script>

<template>
  <Toast />
  <aside class="sidebar">
    <div class="sidebar-header">
      <h3>EMS</h3>
    </div>
    <ul class="sidebar-menu">
      <li v-for="item in menuItems" :key="item.label">
        <router-link
          :to="item.link"
          class="sidebar-item"
          active-class="active"
          exact-active-class="active"
        >
          <i :class="item.icon"></i>
          <span>{{ item.label }}</span>
        </router-link>
      </li>
      <li>
        <button @click="onLogout" class="sidebar-item">
          <i class="pi pi-sign-out"></i>
          <span>Logout</span>
        </button>
      </li>
    </ul>
  </aside>
</template>

<style scoped>
button {
  border: none;
  width: 100%;
  background-color: transparent;
  font-size: medium;
  cursor: pointer;
}
</style>