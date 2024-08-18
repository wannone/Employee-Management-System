<script setup>
import { ref } from 'vue';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { useToast } from "primevue/usetoast";

definePageMeta({
  layout: 'auth',
  middleware: 'direct',
});

useHead({
  titleTemplate: "%s - Register",
});


const register = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

const toast = useToast();

const onRegister = async () => handleRegister(register.value, toast)

</script>

<template>
        <Toast />
  <div class="auth-container">
    <div class="auth-form">
      <h2>Register</h2>
      <form @submit.prevent="onRegister">
        <div class="form-group">
          <label for="name">Name</label>
          <InputText type="text" id="name" v-model="register.name" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <InputText type="email" id="email" v-model="register.email" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <InputText type="password" id="password" v-model="register.password" required />
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <InputText type="password" id="password_confirmation" v-model="register.password_confirmation" required />
        </div>
        <div class="form-group">
            <p>
                Allready have an Acoount? <router-link to="/Login" class="route-link">Login</router-link>
            </p>
        </div>
        <Button label="Register" severity="success" type="submit"/>
      </form>
    </div>
  </div>
</template>

<style scoped>
.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f4f4f4;
}

.auth-form {
  background: #fff;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

h2 {
  margin-bottom: 1rem;
}

.form-group {
  margin-bottom: 1rem;
}

label {
  display: block;
  margin-bottom: 0.5rem;
}

input {
  width: 100%;
  padding: 0.5rem;
  border-radius: 4px;
}

.route-link {
  color: #007bff;
  text-decoration: none;
}

.route-link:hover {
  text-decoration: underline;
}
</style>
