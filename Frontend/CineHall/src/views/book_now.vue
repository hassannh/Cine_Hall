


<template>
    <div class="mx-auto my-0 mx-1/4">

        <form class=" flex-col shadow-lg p-12 mt-12 " @submit.prevent="Submit">
            <input class="flex items-center h-12" name="id_user" type="hidden">

            <label class="font-semibold text-xs mt-3 max-w-xs w-full sm:w-full md:w-full ">date</label>
            <input class="flex items-center h-12 text-black max-w-xs w-full sm:w-full md:w-full"  @change="changeDate" type="date" placeholder="date">

            <label class="font-semibold text-xs mt-3 max-w-xs w-full sm:w-full md:w-full ">hall_name</label>
            <input class="flex items-center h-12 text-black max-w-xs w-full sm:w-full md:w-full " :value="movie.hall_number" readonly
                type="text">

            <label class="font-semibold text-xs mt-3 max-w-xs w-full sm:w-full md:w-full ">price</label>
            <input name="price" class="flex items-center h-12 text-black max-w-xs w-full sm:w-full md:w-full " :value="movie.place_price" readonly
                type="text">



            <div class="flex flex-wrap gap-5 mt-5 max-w-xs w-full sm:w-full md:w-full ">
                <label class="flex flex-row gap-1 w-10" v-for="(place, i) in empty_places" :key="i" @click="setSeat(place.place_number)">
                    <input type="radio" name="place_number" :id="'chair' + i" :value="place.hall_number">
                    <img style="width:2rem" :src="'../public/pictures/chair.png'" alt="">
                    <span>{{ place.place_number }}</span>
                </label>

            </div>

            <div class="flex flex-wrap gap-5 mt-5 max-w-xs w-full sm:w-full md:w-full ">
                <label class="flex flex-row gap-1 w-10" v-for="(place, i) in full_places" :key="i" >
                    <input disabled type="radio" :id="'chair' + i" :value="place.hall_number" >
                    <img style="width:2rem" :src="'../public/pictures/chair_Full.png'" alt="">
                    <span>{{ place.place_number }}</span>
                </label>

            </div>

            <button type="submit" class="border border-blue-500 text-blue-500 font-bold py-2 px-4 w-15 mt-3">BOOK
                NOW</button>

        </form>



        <div v-for="place in places">{{ place }}</div>
        <span class="hall_number hidden">{{ movie.hall_number }}</span>
    </div>
</template>












<script>
import axios from 'axios';

export default {
    data() {
        return {
            places :[],
            id_user:[],
            movie: {},
            full_places: [],
            empty_places: [],

            form: {
                id_user: '',
                hall_name: '',
                place_number: '',
                booking_date: '',
                price: ''

            },
        };
    },
    methods: {
        setSeat(num){
            console.log(num);
            this.form.place_number = num
        },
        changeDate(e){
            console.log(this.form);
            this.form.booking_date = e.target.value
        },
        async fetchMovie() {
            try {
                const response = await axios.get(
                    `http://localhost/CineHall/Backend/app/controllers/movies/get_movie.php?id=${this.$route.query.is}`
                );
                this.movie = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async fetch_empty_Places() {
            var get_hall_number = document.querySelector(".hall_number")
            var hall_name = "hall_" + get_hall_number.textContent
            try {
                const response = await axios.get(

                    `http://localhost/CineHall/Backend/app/controllers/${hall_name}/get_empty_places.php`
                );
                this.empty_places = response.data;
            } catch (error) {
                console.error(error);
            }
        },

        async fetch_full_Places() {
            var get_hall_number = document.querySelector(".hall_number")
            var hall_name = "hall_" + get_hall_number.textContent
            try {
                const response = await axios.get(

                    `http://localhost/CineHall/Backend/app/controllers/${hall_name}/get_full_places.php`
                );
                this.full_places = response.data;
            } catch (error) {
                console.error(error);
            }
        },

        async Submit() {

            try {
                const id_user = JSON.parse(localStorage.getItem("id_user"));
                this.form.hall_name = this.movie.hall_number,
                this.form.price = this.movie.place_price,
                this.form.id_user = id_user,

                console.log(this.form);
                stop

                axios.post('http://localhost/CineHall/Backend/app/controllers/reservation/add_reservation.php', JSON.stringify(this.form))
                    .then(res => res.data.message)

                    .catch(function (error) {
                        console.log(error);
                    });

                this.$router.push({ path: "/booking" });
            } catch (error) {
                console.error(error)
            }
        }



    },mounted(){
        console.log(this.$data)
    },
    created() {
        this.fetchMovie().then(() => this.fetch_empty_Places());
        this.fetchMovie().then(() => this.fetch_full_Places());
    },
};





</script>