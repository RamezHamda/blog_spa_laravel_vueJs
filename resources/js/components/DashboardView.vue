<template>
    <div id="backend-view">
        <div class="logout"><a href="#" @click="logout">Log out</a></div>
        <h1 class="heading">Dashboard</h1>
        <span>Hi {{ name }} ?</span>
        <div class="links">
            <ul>
                <li><router-link :to="{ name: 'create-post' }">Create Posts</router-link></li>

                <li><router-link :to="{name:'create-category'}">Create Category</router-link></li>

                <li>
                <router-link :to="{ name: 'categoriesList' }">Categories List</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
  
<script>
import { RouterLink, RouterView } from 'vue-router'
import axios from 'axios';
export default {
    data() {
        return {
            name : '',
            errors: ''
        }
    },
    methods: {
        logout() {
            axios.post('api/logout')
            .then(response => {
                // console.log(response);
                this.$router.push({name: 'home'})
                // localStorage.setItem('authentcated',false)
                localStorage.removeItem('authentcated')
                this.$emit('updateSidebar')
            })
            .catch(error => {
                console.log(error.response.data.message);
                this.errors = error.response.data.message
            })
        }
    },
    mounted() {
        axios.get('api/user')
        .then(response => {
            this.name = response.data.name
        })
        .catch(error => {
            if(error.response.status == 401) {
                this.$emit('updateSidebar')
                localStorage.removeItem('authentcated')
                this.$router.push({name: 'login'})
            }
        })
    },
};
</script>
  
<style scoped>
/* dashboard */
#backend-view {
    text-align: center;
    background-color: #f3f4f6;
    height: 100vh;
    padding-top: 15vh;
}

.logout {
    position: absolute;
    top: 30px;
    right: 40px;
}

.heading {
    margin-bottom: 5px;
}

.links {
    margin-top: 30px;
    margin-left: auto;
    margin-right: auto;
    background: #ffffff;
    max-width: 500px;
    padding: 15px;
    border-radius: 15px;
}

.links ul {
    list-style: none;
}

.links a {
    all: revert;
    font-size: 26px;
    display: inline-block;
    margin: 10px 0;
}
</style>