<template>
  <div class="min-h-screen grid place-items-center font-mono mt-6 gap-8">
    <h1>Here you go choose a hall to watch a movie</h1>
    <div>
      <label for="date" class="block text-gray-700 font-bold mb-2">Date:</label>
      <input
        class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
        type="date"
        id="input-date"
        :min="new Date().toISOString().slice(0, 10)"
      />
    </div>
    <div v-if="this.items.length === 0">
      <p>No movies avelable</p>
    </div>

    <div
      class="bg-white rounded-md bg-gray-800 shadow-lg"
      style="width: 69%"
      v-for="item in items"
      :key="item.id"
    >
      <div class="md:flex px-4 leading-none max-w-4xl">
        <div class="flex-none">
          <img
            :src="'/pictures/' + item.picture"
            alt="pic"
            class="h-72 w-56 rounded-md shadow-2xl transform -translate-y-4 border-4 border-gray-300 shadow-lg"
          />
        </div>

        <div class="flex-col text-gray-300">
          <p class="pt-4 text-2xl font-bold">
            *{{ item.name }} Hall {{ item.hall_number }}
          </p>
          <hr class="hr-text" data-content="" />
          <div class="text-md flex justify-between px-4 my-2">
            <span class="font-bold">
              {{ item.time }} | Crime, Drama, Thriller</span
            >
            <span class="font-bold"></span>
          </div>
          <p class="hidden md:block px-4 my-4 text-sm text-left">
            {{ item.description }}
          </p>

          <p class="flex text-md px-4 my-2">
            Rating: 9.0/10
            <span class="font-bold px-2">|</span>
            price: {{ item.place_price }} $
          </p>

          <div class="text-xs">
            <button
              type="button"
              class="border border-gray-400 text-gray-400 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-900 focus:outline-none focus:shadow-outline"
            >
              <router-link :to="{ name: 'book_now', query: { is: item.id } }"
                >Book Now</router-link
              >
            </button>
          </div>
          <!--<p>ICON BTNS</p> -->
        </div>
      </div>
    </div>
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .booking {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
  setup() {
    const items = ref([]);

    const fetchData = async () => {
      const response = await axios.get(
        "http://localhost/CineHall/Backend/app/controllers/movies/movies.php"
      );
      items.value = response.data;
    };

    const fetchDataByDate = async (date) => {
      const response = await axios.post(
        "http://localhost/CineHall/Backend/app/controllers/movies/filter.php",
        { date: date }
      );
      items.value = response.data;
    };

    onMounted(() => {
      fetchData();
      const inputDate = document.getElementById("input-date");
      inputDate.onchange = () => {
        const dateValue = new Date(inputDate.value);

        if (dateValue.getDay() === 0) {
          alert("La date sélectionnée est un dimanche !");
        } else {
          const date = inputDate.value;
          fetchDataByDate(date);
        }
      };
    });

    return { items };
  },


};
</script>
