<script setup>
import { useCookie } from "#app";
import '~/assets/css/navbar.css';

const user = useCookie('user');
const usermail = useCookie('email');

const name = user.value;
const email = usermail.value;

</script>

<template>
    <div class="navbar">
        <p class="navbar-headline">{{ name }}</p>
        <p class="navbar-subheadline">{{ email }}</p>
    </div>
</template>