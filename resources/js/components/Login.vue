<template>
  <div class="auth-page">
    <h2>Login</h2>
    <form @submit.prevent="login">
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          v-model="email"
          id="email"
          placeholder="Enter your email"
          required
        />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          type="password"
          v-model="password"
          id="password"
          placeholder="Enter your password"
          required
        />
      </div>
      <button type="submit" class="btn-submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    async login() {
      try {

        const response = await axios.post('/api/login', {
          email: this.email,
          password: this.password,
        })
        
        localStorage.setItem('token', response.data.token)
        this.$router.push({ name: 'Home' })
      } catch (error) {
        console.error("Login error:", error)
      }
    },
  },
}
</script>

<style scoped>
.auth-page {
  max-width: 400px;
  margin: 50px auto;
  padding: 30px 20px;
  background: #fff;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.auth-page h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}


.auth-page form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}


.form-group {
  display: flex;
  flex-direction: column;
}
.form-group label {
  margin-bottom: 5px;
  font-weight: bold;
  color: #555;
}
.form-group input {
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition: border-color 0.3s ease;
}
.form-group input:focus {
  border-color: #5d9cec;
  outline: none;
}

.btn-submit {
  padding: 12px;
  font-size: 1.1rem;
  background-color: #5d9cec;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.btn-submit:hover {
  background-color: #4a89dc;
}


@media (max-width: 600px) {
  .auth-page {
    margin: 20px;
    padding: 20px;
  }
}
</style>
