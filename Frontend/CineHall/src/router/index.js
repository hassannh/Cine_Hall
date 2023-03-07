import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import book_now from '../views/book_now.vue'
import tickets from '../views/tickets.vue'
import login from '../components/login.vue'
import Register from '../components/Register.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    // {
    //   path: '/Halls',
    //   name: 'Halls',
    //   component: TheHall_1
    // },
    {
      path: '/booking',
      name: 'booking',
      component: () => import('../views/Booking_place.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/tickets',
      name: 'tickets',
      component: tickets
    },
    {
      path: '/Register',
      name: 'Register',
      component: Register
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/book_now',
      name: 'book_now',
      component: () => import('../views/book_now.vue')
    }
  ]
})

export default router
