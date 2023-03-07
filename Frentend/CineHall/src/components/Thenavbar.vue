<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
   
    <nav class="flex justify-between items-center w-[70%]">
      <div>
          <img class="w-16" src="../../public/pictures/cinemaLogo.png" alt="">
      </div>
      <div class="md:static absolute md:min-h-fit min-h-[30vh] left-0 top-[200%] md:w-auto w-full flex-items-center px-5">
          <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vh] gap-8">
            <li>
              <RouterLink to="/"> <a  class="hover:text-gray-500">Home</a></RouterLink>
            </li>
            <li>
              <RouterLink to="/about"> <a class="hover:text-gray-500" href="">about</a></RouterLink>
            </li>
            <li>
              <RouterLink to="/booking"> <a class="hover:text-gray-500" href="">booking</a> </RouterLink>
            </li>
            <li>
              <RouterLink to="/tickets"> <a class="hover:text-gray-500" href="">ticket</a> </RouterLink>
            </li>
          </ul>
      </div>
      <div>
        <button class="text-white px-5 py-2">Login</button>
        <!-- <ion-icon name="menu"></ion-icon> -->
      </div>
    </nav>
    
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




