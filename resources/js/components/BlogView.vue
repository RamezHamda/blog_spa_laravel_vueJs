<template>
    <main class="container">
      <h2 class="header-title">All Blog Posts</h2>
      <div class="searchbar">
        <form action="">
          <input type="text" placeholder="Search..." name="search" v-model="title"/>

          <button type="submit">
            <i class="fa fa-search"></i>
          </button>

        </form>
      </div>
      <div class="categories">
        <ul>
          <li v-for="category in categories" :key="category.id">
            <a href="#" @click="filterByCategory(category.name)">{{ category.name }}</a>
          </li>
        </ul>
      </div>
      <section class="cards-blog latest-blog">

        <div class="card-blog-content" v-for="post in posts" :key="post.id">
          <img :src="post.imagePath" alt="" />
          <p>
            {{ post.created_at }}
            <span>Written By {{ post.user }}</span>
          </p>
          <h4>
            <router-link :to="{name:'single-blog' ,params:{slug: post.slug}}">{{ post.title }}</router-link>
          </h4>
        </div>
        
      </section>
      <h3 v-if="!posts.length">Sorry, Your Search is: {{ title }}  not Found</h3>
        
      <div class="pagination" id="pagination">
          <a 
          href="#" 
          v-for="(link,index) in links" 
          :key="index" 
          v-html="link.label"
          :class="{active: link.active , disabled:!link.url || link.active}"
          @click="changePage(link)"
          >
        </a>
      </div>
    </main>
</template>

<script>
import axios from "axios";

export default {
  name: "BlogView",
  data() {
    return {
      posts: [],
      categories: [],
      title: "",
      links: [],
    };
  },
  methods: {
    filterByCategory(name) {
      axios.get("api/postsBlog", { params: { category: name } })
      .then((response) => {
        this.links = response.data.meta.links;
        this.posts = response.data.data;
      });
    },

    changePage(link){
      if(!link.url){
        return;
      }

      axios.get(link.url)
      .then((response) => {
        this.links = response.data.meta.links;
        this.posts = response.data.data;
      });
    }
  },
  mounted() {
    axios.get("api/postsBlog").then((response) => {
      this.posts = response.data.data;
      this.links = response.data.meta.links;
    });

    axios('api/categories')
    .then((response) => {
      // console.log(response);
      this.categories = response.data;
    });
  },
  watch: {
    title() {
      axios.get("api/postsBlog", { params: { search: this.title } })
      .then((response) => {
        this.links = response.data.meta.links;
        this.posts = response.data.data;
      });
    },
  },


};
</script>

<style scoped>
.disabled {
  pointer-events: none;
}
</style>