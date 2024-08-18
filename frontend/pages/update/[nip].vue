<script setup lang="ts">
import type { Employee } from "~/model/EmployeeModel";
import { ref, onMounted } from 'vue';
import { useRoute, useRuntimeConfig } from '#imports';

definePageMeta({
  middleware: 'auth'
})

useHead({
  titleTemplate: "%s - Update Employee",
});

const config = useRuntimeConfig();
const route = useRoute();
const nip = route.params.nip;
const data = ref<Employee | null>(null);

onMounted(async () => {
    try {
        const response = await fetch(`${config.public.apiBase}/employee/${nip}`);
        const result = await response.json();
        data.value = result.data[0];        
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});

</script>

<template>
    <div v-if="data" class="form-container">
        <EmployeeForm :employee="data" formType="update" />
    </div>
    <div v-else>
        <p>Loading...</p>
    </div>
</template>
