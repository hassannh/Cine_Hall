

<template>

   <div class="welcome_home mt-6">
      <img src="../../public/pictures/home_cinema.jpg" alt="">
   </div>

   <!-- <TheWelcome /> -->

   <div class="items-center justify-center mx-8 my-6">
      <h1>NEW MOVIES</h1>

      <div class="grid grid-cols-12 gap-2 gap-y-4 mt-6">

         <!-- Video 1 -->
         <div class="col-span-12 sm:col-span-6 md:col-span-3" v-for="item in items" :key="item.id">
            <card class="w-full flex flex-col">
               <div class="relative">

                  <!-- Image Video -->
                  <a href="#">
                     <img :src="'../../public/pictures/' + item.picture">
                  </a>

                  <p class="absolute right-2 bottom-2 bg-gray-900 text-gray-100 text-xs px-1 py">{{ item.time }}</p>
               </div>

               <div class="flex flex-row mt-2 gap-2">

                  <!-- Description -->
                  <div clas="flex flex-col">
                     <a href="#">
                        <p class="text-gray-100 text-sm font-semibold">{{ item.name }}</p>
                     </a>
                     <a class="text-gray-400 text-xs mt-2 hover:text-gray-100" href="#"> Hall number {{item.hall_number}} </a>
                     <p class="text-gray-400 text-xs mt-1">241K views . 3 years ago</p>
                  </div>
               </div>
            </card>
         </div>

      </div>
   </div>



</template>


<script>

import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
   setup() {
      const items = ref([]);

      const fetchData = async () => {
         const response = await axios.get('http://localhost/CineHall/Backend/app/controllers/movies/movies.php');
         items.value = response.data;
      };


      onMounted(() => {
         fetchData();
      });

      return { items };

   },
};
</script>








