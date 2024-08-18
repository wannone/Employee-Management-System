<script setup lang="ts">
definePageMeta({
  middleware: 'auth'
})
import { ref, onMounted } from 'vue';
import { getAllEmployee } from '~/utils/GetAllEmployee';
import { useToast } from 'primevue/usetoast';
import type { EmployeeTableType } from '~/model/EmployeeModel';

useHead({
  titleTemplate: '%s - Show Data',
})

const data = ref([] as EmployeeTableType[]);
const toast = useToast();

onMounted(async () => {
  data.value = await getAllEmployee(toast);
});
</script>

<template>
  <div>
    <Toast />
    <div style="padding: 10px; background-color: white; border-radius: 10px; ">
      <EmployeeTable :tableData="data" />
    </div>
  </div>
</template>
