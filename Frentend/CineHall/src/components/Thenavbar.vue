<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <div class="wrapper">
      <!-- <HelloWorld /> -->

      <nav>

        <!-- <RouterLink to="/home"><img class="logo" src="../../public/pictures/logo.png" ></RouterLink> -->
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
        <RouterLink to="/booking">booking</RouterLink>
        <RouterLink to="/tickets">tickets</RouterLink>
        <RouterLink to="/login">login</RouterLink>
      </nav>

    </div>
  </header>

  <RouterView />
  
</template>

<style scoped>

.logo {
    display: inline-block;
    vertical-align: top;
}

nav {
  width: 100%;
  font-size: 12px;
  /* text-align: center; */
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

</style>
