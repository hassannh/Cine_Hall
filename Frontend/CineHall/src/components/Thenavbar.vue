<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useAuthStore } from '../stores/Auth';
import {initModals} from 'flowbite'
import { onMounted } from 'vue';

const authStore = useAuthStore()
onMounted(()=>{
  initModals()
})
</script>

<template>

<div class="flex flex-wrap place-items-center">
  <section class="relative mx-auto">
      <!-- navbar -->
    <nav class="flex justify-between text-white">
      <div class="px-5 xl:px-12 py-6 flex w-full items-center">
        <a class="text-3xl font-bold font-heading" href="#">
          <img class="h-12" src="../../public/pictures/cinemaLogo.png" alt="logo">
          
        </a>
        <!-- Nav Links -->
        <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
          <RouterLink to="/">
          <li><a class="hover:text-gray-200">Home</a></li>
          </RouterLink>
          <RouterLink to="/about">
          <li><a class="hover:text-gray-200">About</a></li>
          </RouterLink>
          <RouterLink to="/Booking">
          <li><a class="hover:text-gray-200">Booking</a></li>
          </RouterLink>
        
          <RouterLink to="/Tickets" v-if="authStore.user">
          <li><a class="hover:text-gray-200">Tickets</a></li>
          </RouterLink>
      
          
        </ul>
        <!-- Header Icons -->
        <div class="hidden xl:flex items-center space-x-5 items-center">
         
         
          <!-- Sign In / Register      -->
          <RouterLink to="/login">
          <a class="flex items-center hover:text-gray-200" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
          </a>
          </RouterLink>
        </div>
      </div>
      <!-- Responsive navbar -->
      <a class="navbar-burger self-center mr-12 xl:hidden" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
      </a>
    </nav>
    
  </section>
</div>
<!-- Does this resource worth a follow? -->
<div class="absolute bottom-0 right-0 mb-4 mr-4 z-10">
    <div>
        <a title="Follow me on twitter" href="https://www.twitter.com/asad_codes" target="_blank" class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
            <img class="object-cover object-center w-full h-full rounded-full" src="https://www.imore.com/sites/imore.com/files/styles/large/public/field/image/2019/12/twitter-logo.jpg"/>
        </a>
    </div>
</div>


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




