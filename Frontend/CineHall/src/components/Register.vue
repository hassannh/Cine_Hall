<template>

  <body class="flex flex-col items-center justify-center w-screen h-screen text-gray-700">

    <!-- Component Start -->

    <form class="flex flex-col shadow-lg p-12 mt-12" @submit.prevent="handleSubmit">
      <label class="" for="usernameField">Username</label>
      <input class="flex items-center h-12 w-64" type="text" v-model="form.username">

      <label class="" for="email">Email</label>
      <input class="flex items-center h-12 w-64" type="text" v-model="form.email">

      <label class="font-semibold text-xs mt-3" for="passwordField">password</label>
      <input class="flex items-center  h-12  w-64 " type="password" v-model="form.password">

      <button class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 text-blue-100 hover:bg-blue-700"
        type="submit">Register</button>
      <div class="flex mt-6 justify-center text-xs">
        <a class="text-blue-400 hover:text-blue-500" href="./login">login</a>
      </div>
    </form>

    <div key="content-key">
      <h1>{{ token }}</h1>
      
    </div>
    <!-- Component End  -->

  </body>

</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      token: '',
      form: {
        username: '',
        email: '',
        password: ''
      },
    }
  },

  methods: {
    async handleSubmit() {
      try {
        axios.post('http://localhost/CineHall/Backend/app/controllers/user/register.php', JSON.stringify(this.form))
          .then(res => this.token = res.data.resulte)
          .catch(function (error) {
            console.log(error);
          });

        // this.$router.push({ path: "/login" });
      } catch (error) {
        console.error(error)
      }
    }

  }
}
</script>