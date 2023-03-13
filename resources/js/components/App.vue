<template>
    <div>
        <div id="wrapper">
            <!-- sidebar -->
            <div class="sidebar" :class="{showOverlay:overlayVisibility}">
                <span class="closeButton" @click="hideOverlay">&times;</span>
                <p class="brand-title"><a href="">Alphayo Blog</a></p>

                <div class="side-links">
                    <ul>
                        <li>
                            <RouterLink @click="hideOverlay" :to="{name:'home'}">Home</RouterLink>
                        </li>
                        <li>
                            <RouterLink @click="hideOverlay" :to="{name:'about'}">About</RouterLink>
                        </li>
                        <li>
                            <RouterLink @click="hideOverlay" :to="{name:'blog'}">Blog</RouterLink>
                        </li>
                        <li>
                            <RouterLink @click="hideOverlay" :to="{name:'contact'}">Contact</RouterLink>
                        </li>
                        <li v-if="!loggedIn">
                            <RouterLink @click="hideOverlay" :to="{name:'login'}">Login</RouterLink>
                        </li>
                        <li v-if="!loggedIn">
                            <RouterLink @click="hideOverlay" :to="{name:'register'}">Register</RouterLink>
                        </li>
                        <li v-if="loggedIn">
                            <RouterLink @click="hideOverlay" :to="{name:'dashboard'}">Dashboard</RouterLink>
                        </li>
                        <!-- <li v-if="loggedIn">
                            <RouterLink @click="hideOverlay" :to="{name:'create-category'}">Add Category</RouterLink>
                        </li>
                        <li v-if="loggedIn">
                            <RouterLink @click="hideOverlay" :to="{name:'categoriesList'}">All Categories</RouterLink>
                        </li> -->
                    </ul>
                </div>

                <!-- sidebar footer -->
                <footer class="sidebar-footer">
                    <div>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                    </div>

                    <small>&copy 2021 Alphayo Blog</small>
                </footer>
            </div>
            <!-- Menu Button -->
            <div class="menuButton" @click="showOverlay">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>


            <!-- main -->
            <main class="container">
                <RouterView @update-sidebar="updateSidebar"></RouterView>
            </main>

            <!-- Main footer -->
            <footer class="main-footer">
                <div>
                    <a href=""><i class="fab fa-facebook-f"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                </div>
                <small>&copy; 2021 Alphayo Blog</small>
            </footer>
        </div>
    </div>
</template>

<script>
import { RouterLink, RouterView } from 'vue-router'

export default {
    name: 'App',
    data() {
        return {
            overlayVisibility: false,
            loggedIn: false
        }
    },
    methods: {
        hideOverlay() {
            this.overlayVisibility = false
        },
        showOverlay() {
            this.overlayVisibility = true
        },
        updateSidebar() {
            this.loggedIn = !this.loggedIn
        },

    },
    mounted(){
        if(localStorage.getItem('authentcated')){
            this.loggedIn = true
        }else{
            this.loggedIn = false
        }
    }

}
</script>

<style scoped>

.showOverlay {
    width: 100%;
    z-index: 5;
}
</style>

