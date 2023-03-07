

<template>




</template>




<script>

import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
   setup() {
      const items = ref([]);

      const fetchData = async () => {
         const response = await axios.get('http://localhost/CineHall/Backend/app/controllers/reservation/');
         items.value = response.data;
      };


      onMounted(() => {
         fetchData();
      });

      return { items };

   },
};

</script>