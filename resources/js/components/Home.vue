<template>
  <div class="container home-page">
    <header>
      <h1>Wardrobe Management System</h1>
      <nav>
        <router-link to="/">Home</router-link> |
        <router-link to="/login">Login</router-link> |
        <router-link to="/register">Register</router-link>
      </nav>
    </header>
    
    <section class="filter-section">
      <input type="text" v-model="searchQuery" placeholder="Search items" />
      <select v-model="selectedCategory">
        <option value="">All Categories</option>
        <option value="tops">Tops</option>
        <option value="bottoms">Bottoms</option>
        <option value="shoes">Shoes</option>
      </select>
    </section>
    
    <section>
      <button class="btn-add" @click="goToNewItem">Add New Item</button>
    </section>
    
    <ul class="clothing-list">
      <li v-for="item in filteredItems" :key="item.id">
        <h3>{{ item.name }} <span>({{ item.category }})</span></h3>
        <p>{{ item.description }}</p>
        <div class="item-actions">
          <button @click="editItem(item.id)">Edit</button>
          <button @click="deleteItem(item.id)">Delete</button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data() {
    return {
      searchQuery: '',
      selectedCategory: '',
      
      items: [
        { id: 1, name: 'Blue Shirt', category: 'tops', description: 'A blue shirt for casual wear' },
        { id: 2, name: 'Black Trousers', category: 'bottoms', description: 'Stylish black trousers' },
        { id: 3, name: 'Pink Sweater', category: 'tops', description: 'Comfortable and warm pink sweater' },
        { id: 3, name: 'Nike Sneakers', category: 'shoes', description: 'Original nike sneakers' },
        { id: 3, name: 'White Boxers', category: 'bottoms', description: 'Original nike boxers' },
        { id: 3, name: 'White Sneakers', category: 'shoes', description: 'Comfortable white sneakers' }
      ]
    }
  },
  computed: {
    filteredItems() {
      return this.items.filter(item => {
        const matchesCategory = this.selectedCategory
          ? item.category === this.selectedCategory
          : true;
        const matchesSearch = this.searchQuery
          ? item.name.toLowerCase().includes(this.searchQuery.toLowerCase())
          : true;
        return matchesCategory && matchesSearch;
      });
    }
  },
  methods: {
    goToNewItem() {
      
      this.$router.push({ name: 'NewItem' });
    },
    editItem(id) {
      
      this.$router.push({ name: 'EditItem', params: { id } });
    },
    deleteItem(id) {
      
      this.items = this.items.filter(item => item.id !== id);
    }
  },
  mounted() {
    
  }
}
</script>

<style scoped>

.container {
  max-width: 800px;
  margin: 40px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 6px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}


.home-page header {
  text-align: center;
  margin-bottom: 30px;
}
.home-page header h1 {
  font-size: 2.5rem;
  margin: 0;
}
.home-page nav {
  margin-bottom: 20px;
}
.home-page nav a {
  text-decoration: none;
  color: #5d9cec;
  margin: 0 10px;
  font-size: 1.1rem;
  transition: color 0.3s ease;
}
.home-page nav a:hover {
  color: #4a89dc;
}


.filter-section {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.filter-section input[type="text"] {
  flex: 1;
  padding: 10px;
  margin-right: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.filter-section select {
  width: 150px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}


.btn-add {
  display: block;
  width: 100%;
  padding: 12px;
  font-size: 1.1rem;
  background-color: #5d9cec;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-bottom: 20px;
  transition: background-color 0.3s ease;
}
.btn-add:hover {
  background-color: #4a89dc;
}


.clothing-list {
  list-style: none;
  padding: 0;
}
.clothing-list li {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 15px;
  margin-bottom: 15px;
  background-color: #fafafa;
}
.clothing-list h3 {
  margin: 0 0 10px;
  color: #333;
}
.clothing-list h3 span {
  font-size: 0.9rem;
  color: #777;
}
.clothing-list p {
  font-size: 0.95rem;
  color: #666;
}
.item-actions {
  margin-top: 10px;
}
.item-actions button {
  padding: 8px 12px;
  font-size: 0.9rem;
  background-color: #5d9cec;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 10px;
  transition: background-color 0.3s ease;
}
.item-actions button:hover {
  background-color: #4a89dc;
}


@media (max-width: 600px) {
  .container {
    margin: 20px;
    padding: 15px;
  }
  .home-page nav a {
    display: block;
    margin: 10px 0;
  }
  .filter-section {
    flex-direction: column;
  }
  .filter-section input[type="text"] {
    margin: 0 0 10px 0;
  }
  .filter-section select {
    width: 100%;
  }
}
</style>
