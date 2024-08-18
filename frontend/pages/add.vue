<script setup lang="ts">
import type { Employee } from "~/model/EmployeeModel";

definePageMeta({
  middleware: 'auth'
})
useHead({
  titleTemplate: "%s - Add Data",
});


const employee = ref<Employee>({
  nip: "",
  name: "",
  birthdate: "",
  birthplace: "",
  address: "",
  gender: "",
  group: 0,
  eselon: 0,
  position: "",
  workplace: 0,
  religion: 0,
  unit: 0,
  phone: "",
  npwp: "",
  image_url: "",
});

</script>
<template>
  <section>
    <div class="form-container">
      <div class="form-header">
        <h1>Add Data</h1>
        <p>Fill the form below to add new data</p>
      </div>
      <EmployeeForm :employee="employee" formType="post" />
    </div>
  </section>
</template>