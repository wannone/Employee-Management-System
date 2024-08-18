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
  titleTemplate: "%s - Login",
});

const login = ref({
  email: '',
  password: ''
});

const toast = useToast();

const onLogin = async () => await handleLogin(login.value, toast)
</script>

<template>
    <Toast />
  <div class="auth-container">
    <div class="auth-form">
      <h2>Login</h2>
      <form @submit.prevent="onLogin">
        <div class="form-group">
          <label for="email">Email</label>
          <InputText type="email" id="email" v-model="login.email" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <InputText type="password" id="password" v-model="login.password" required />
        </div>
        <div class="form-group">
            <p>
                Don't have an account? <router-link to="/register" class="route-link">Register</router-link>
            </p>
        </div>
        <Button label="Login" severity="success" type="submit"/>
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