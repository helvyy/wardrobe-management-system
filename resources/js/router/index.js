import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import ClothingItemList from '../components/ClothingItemList.vue'
import ClothingItemForm from '../components/ClothingItemForm.vue'

const routes = [
  { path: '/', name: 'Home', component: ClothingItemList },
  { path: '/login', name: 'Login', component: Login },
  { path: '/register', name: 'Register', component: Register },
  { path: '/item/new', name: 'NewItem', component: ClothingItemForm },
  { path: '/', name: 'Home', component: Home },
  { path: '/item/edit/:id', name: 'EditItem', component: ClothingItemForm, props: true },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
