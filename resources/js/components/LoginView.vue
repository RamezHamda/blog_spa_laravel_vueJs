<template>
    <div id="backend-view">
      <form @submit.prevent="submit">
        <div v-if="errors.length" class="alert alert-danger">
          <ul>
            <!-- <li v-for="error in errors">{{ error }}</li> -->
            <li>{{ errors }}</li>
          </ul>
        </div>
        <h3>Login Here</h3>
        <label for="email">Email</label>
        <input type="text" id="email" v-model="fields.email" />
  
        <label for="password">Password</label>
        <input type="password" id="password" v-model="fields.password"/>
  
        <button type="submit">Log In</button>
        <span>Don't have an account? <router-link :to="{name:'register'}">Sign up</router-link></span>
      </form>
     </div>
  </template>
  
  <script>
  import { RouterLink, RouterView } from 'vue-router'
  export default {
    data() {
        return {
            fields: {
                email: '',
                password: '',
            },
            errors: ''
        }
    },
    methods: {
        submit() {
            axios.post('api/login', this.fields)
            .then(response => {
                // this.fields = response.data.data
                this.$router.push({name: 'dashboard'})
                localStorage.setItem('authentcated',true)
                this.$emit('updateSidebar')
            })
            .catch(error => {
                this.errors = error.response.data.message
            })
        }
    }
  };
  </script>
  
  <style scoped>
  #backend-view {
    height: 100vh;
    background-color: #f3f4f6;
    display: grid;
    align-items: center;
  }
  form {
    width: 400px;
    background-color: #ffffff;
    margin: 0 auto;
    border-radius: 10px;
    border: 2px solid rgba(255, 255, 255, 0.1);
    padding: 50px 35px;
  }
  form * {
    letter-spacing: 0.5px;
    outline: none;
  }
  label {
    display: block;
    margin-top: 20px;
    font-size: 16px;
    font-weight: 500;
  }
  input {
    display: block;
    height: 50px;
    width: 100%;
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 16px;
    font-weight: 300;
    border: 1px solid rgba(0, 0, 0, 0.1);
  }
  button {
    margin-top: 50px;
    width: 100%;
    background-color: rgba(0, 46, 173, 0.7);
    color: #ffffff;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
  }
  form span {
    display: block;
    margin-top: 35px;
  }
  a {
    color: rgba(0, 46, 173, 0.8);
  }
  </style>