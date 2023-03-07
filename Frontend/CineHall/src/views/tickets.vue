<template>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<div class="body" v-for="movie in movies" :key="movie.id">
		<div class="ticket">
			<div class="left">
				<div class="image">
					<img :src="'../../public/pictures/' + movie.picture" style="height: 250px;width: 250px;position: absolute;z-index: 0;">
					<p class="admit-one">
						<span>ADMIT ONE</span>
						<span>ADMIT ONE</span>
						<span>ADMIT ONE</span>
					</p>
					<div class="ticket-number">
                    <p>
                        #{{ movie.place_number }}
                    </p>
                </div>
				</div>
				<div class="ticket-info">
					<p class="date">
						<span>Date</span>
						<span class="june-29">{{ movie.booking_date }}</span>
						<span>2023</span>
					</p>
					<div class="show-name">
						<h1>{{ movie.name }}</h1>
						<h2>Hall {{ movie.hall_name }} </h2>
					</div>
					<div class="time">
						<p>8:00 PM <span>TO</span> 11:00 PM</p>
						<p>DOORS <span>@</span> 7:00 PM</p>
					</div>
					<p class="location"><span>East YouCode School</span>
						<span class="separator"><i class="far fa-smile"></i></span><span>Safi City, Cinema</span>
					</p>
				</div>
			</div>
			<div class="right">
				<p class="admit-one">
					<span>ADMIT ONE</span>
					<span>ADMIT ONE</span>
					<span>ADMIT ONE</span>
				</p>
				<div class="right-info-container">
					<div class="show-name">
						<h1>Cine Hall</h1>
					</div>
					<div class="time">
						<p>8:00 PM <span>TO</span> 11:00 PM</p>
						<p>DOORS <span>@</span> 7:00 PM</p>
					</div>
					<div class="barcode">
						<button class="btn btn-primary bg-blue">Remove</button>
					</div>
					<p class="ticket-number">
						Place N: {{ movie.place_number }}
					</p>
				</div>
			</div>
		</div>
	</div>
</template>


<style>
@import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");


.body {
	padding: 0;
	box-sizing: border-box;
	margin: 0;
	height: 100vh;
	display: grid;
	font-family: "Staatliches", cursive;
	background: #0e0b0c;
	color: black;
	font-size: 14px;
	letter-spacing: 0.1em;
}

.ticket {
	margin: auto;
	display: flex;
	background: white;
	box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
}

.left {
	display: flex;
}

.image {
	height: 250px;
	width: 250px;
	background-size: contain;
	opacity: 0.85;
}

.admit-one {
	position: absolute;
	color: darkgray;
	height: 250px;
	padding: 0 10px;
	letter-spacing: 0.15em;
	display: flex;
	text-align: center;
	justify-content: space-around;
	writing-mode: vertical-rl;
	transform: rotate(-180deg);
}

.admit-one span:nth-child(2) {
	color: white;
	font-weight: 700;
}

.left .ticket-number {
	height: 250px;
	width: 250px;
	display: flex;
	justify-content: flex-end;
	align-items: flex-end;
	padding: 5px;
}

.ticket-info {
	padding: 10px 30px;
	display: flex;
	flex-direction: column;
	text-align: center;
	justify-content: space-between;
	align-items: center;
}

.date {
	border-top: 1px solid gray;
	border-bottom: 1px solid gray;
	padding: 5px 0;
	font-weight: 700;
	display: flex;
	align-items: center;
	justify-content: space-around;
}

.date span {
	width: 100px;
}

.date span:first-child {
	text-align: left;
}

.date span:last-child {
	text-align: right;
}

.date .june-29 {
	color: #d83565;
	font-size: 20px;
}

.show-name {
	font-size: 32px;
	font-family: "Nanum Pen Script", cursive;
	color: #d83565;
}

.show-name h1 {
	font-size: 48px;
	font-weight: 700;
	letter-spacing: 0.1em;
	color: #4a437e;
}

.time {
	padding: 10px 0;
	color: #4a437e;
	text-align: center;
	display: flex;
	flex-direction: column;
	gap: 10px;
	font-weight: 700;
}

.time span {
	font-weight: 400;
	color: gray;
}

.left .time {
	font-size: 16px;
}


.location {
	display: flex;
	justify-content: space-around;
	align-items: center;
	width: 100%;
	padding-top: 8px;
	border-top: 1px solid gray;
}

.location .separator {
	font-size: 20px;
}

.right {
	width: 180px;
	border-left: 1px dashed #404040;
}

.right .admit-one {
	color: darkgray;
}

.right .admit-one span:nth-child(2) {
	color: gray;
}

.right .right-info-container {
	height: 250px;
	padding: 10px 10px 10px 35px;
	display: flex;
	flex-direction: column;
	justify-content: space-around;
	align-items: center;
}

.right .show-name h1 {
	font-size: 18px;
}

.barcode {
	height: 100px;
}

.barcode img {
	height: 100%;
}

.right .ticket-number {
	color: gray;
}
</style>


<script>

import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
	
   setup() {
      const movies = ref([])
	
		const id_user = JSON.parse(localStorage.getItem("id_user"));
      const fetchData = async () => {
         const response = await axios.get(`http://localhost/CineHall/Backend/app/controllers/reservation/get_reservation.php?id=${id_user}`);
         movies.value = response.data;
      };


      onMounted(() => {
         fetchData();
      });

      return { movies};

   },
};
</script>