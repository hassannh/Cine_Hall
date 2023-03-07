<template>

<body class="flex flex-col items-center justify-center w-screen h-screen text-gray-700">

<!-- Component Start -->

<form class="flex flex-col shadow-lg p-12 mt-12" @submit.prevent="handleSubmit">
    <label class="font-semibold text-xs mt-3" for="password">Token</label>
    <input class="flex items-center  h-12  w-64 " type="password" v-model="token">
    <button class="flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 text-blue-100 hover:bg-blue-700" type="submit">Login</button>
    <div class="flex mt-6 justify-center text-xs">
        <span class="mx-2 text-gray-300">/</span>
        <a class="text-blue-400 hover:text-blue-500" href="./Register">Sign Up</a>
    </div>
</form>
<!-- Component End  -->

</body>

</template>

  
  <script>
  import axios from 'axios'
  export default {
    data() {
      return {
        form: {
          token: ''
        },
        token : null,
        data:{}
      }
    },
    methods: {
   
      async handleSubmit() {
        try {
          axios.post('http://localhost/CineHall/Backend/app/controllers/user/login.php', JSON.stringify(this.token))
          .then(res => {
            localStorage.setItem("id_user", JSON.stringify( res.data.user.id ));
          })
          
        this.$router.push({ path: "/" });
        } catch (error) {
          console.error(error)
        }
      },
    
  }
  }
  </script>
  
  
  
  
  