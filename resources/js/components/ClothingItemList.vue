<template>
    <div class="clothing-item-list">
      <h2>Clothing Items</h2>
      <div class="filters">
        <input type="text" v-model="search" placeholder="Search items" @input="fetchItems" />
        <select v-model="category" @change="fetchItems">
          <option value="">All Categories</option>
          <option value="tops">Tops</option>
          <option value="bottoms">Bottoms</option>
          <option value="shoes">Shoes</option>
        </select>
      </div>
      <button @click="$router.push('/item/new')">Add New Item</button>
      <ul>
        <li v-for="item in items" :key="item.id">
          <h3>{{ item.name }} ({{ item.category }})</h3>
          <p>{{ item.description }}</p>
          <button @click="editItem(item.id)">Edit</button>
          <button @click="deleteItem(item.id)">Delete</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  export default {
    data() {
      return {
        items: [],
        search: '',
        category: '',
      }
    },
    created() {
      this.fetchItems()
    },
    methods: {
      async fetchItems() {
        try {
          const params = {}
          if (this.search) params.search = this.search
          if (this.category) params.category = this.category
          const response = await axios.get('/clothing-items', { params })
          this.items = response.data
        } catch (error) {
          console.error('Error fetching items:', error)
        }
      },
      editItem(id) {
        this.$router.push({ name: 'EditItem', params: { id } })
      },
      async deleteItem(id) {
        if (confirm('Are you sure you want to delete this item?')) {
          try {
            await axios.delete(`/clothing-items/${id}`)
            this.fetchItems()
          } catch (error) {
            console.error('Error deleting item:', error)
          }
        }
      },
    },
  }
  </script>
  
  <style scoped>
  /* Add styles as needed */
  </style>
  