import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authUser: null,
        authToken: null,
        authError: null
    }),
    getters: {
        user: (state) => state.authUser,
        token: (state) => state.authToken,
        errors: (state) => state.authError
    },
    actions: {
        async handleSubmit(form) {
            console.log(form);
            try {
                this.authToken = form
                axios.post('http://localhost/CineHall/Backend/app/controllers/user/login.php', JSON.stringify(form.token))
                    .then(res => {
                        console.log(res.data.user);
                        localStorage.setItem("id_user", JSON.stringify(res.data.user.id));
                        this.authUser = res.data.user.id
                    })

                this.router.push("/");
            } catch (error) {
                console.error(error)
            }
        },

    }
})