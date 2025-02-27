<template>
  <div class="form-container">
    <h2>{{ isEdit ? 'Edit Clothing Item' : 'Add Clothing Item' }}</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          v-model="item.name"
          placeholder="Enter item name"
          required
        />
      </div>
      
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          id="description"
          v-model="item.description"
          placeholder="Enter item description"
          rows="3"
        ></textarea>
      </div>
      
      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" v-model="item.category" required>
          <option value="">Select Category</option>
          <option value="tops">Tops</option>
          <option value="bottoms">Bottoms</option>
          <option value="shoes">Shoes</option>
          
        </select>
      </div>
      
      <button type="submit" class="btn-submit">
        {{ isEdit ? 'Update Item' : 'Add Item' }}
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'ClothingItemForm',
  props: ['id'], 
  data() {
    return {
      item: {
        name: '',
        description: '',
        category: '',
      },
    }
  },
  computed: {
    isEdit() {
      return !!this.id;
    }
  },
  mounted() {
    if (this.isEdit) {
      this.fetchItem();
    }
  },
  methods: {
    async fetchItem() {
      this.item = {
        name: 'Blue Denim Jacket',
        description: 'A stylish blue denim jacket, perfect for casual wear.',
        category: 'tops'
      };
    },
    async submitForm() {
      if (this.isEdit) {
        this
        console.log('Updating item:', this.item);
      } else {
        
        console.log('Creating new item:', this.item);
      }
      this.$router.push({ name: 'Home' });
    }
  }
}
</script>

<style scoped>

.form-container {
  max-width: 600px;
  margin: 40px auto;
  padding: 30px 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}


.form-container h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #333;
  font-size: 2rem;
}


.form-group {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
}
.form-group label {
  margin-bottom: 8px;
  font-size: 1.1rem;
  color: #555;
}
.form-group input,
.form-group textarea,
.form-group select {
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition: border-color 0.3s ease;
}
.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
  border-color: #5d9cec;
  outline: none;
}


.btn-submit {
  display: block;
  width: 100%;
  padding: 12px;
  font-size: 1.1rem;
  background-color: #5d9cec;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 10px;
}
.btn-submit:hover {
  background-color: #4a89dc;
}


@media (max-width: 600px) {
  .form-container {
    margin: 20px;
    padding: 20px;
  }
}
</style>
