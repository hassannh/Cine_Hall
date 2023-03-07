<template>

  <div v-for="item in items" :key="item.id_place">
    {{ items.place_number }}
  </div>

</template>


<script>


import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const items = ref([]);

    const fetchData = async () => {
      const response = await axios.get('http://localhost/CineHall/Backend/app/controllers/hall_1/get_empty_places.php');
      items.value = response.data;
    };




    onMounted(() => {
      fetchData();
    });

    return { items };

  }
};

</script> 