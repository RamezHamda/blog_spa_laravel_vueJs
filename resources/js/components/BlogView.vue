<template>
    <main class="container">
      <h2 class="header-title">All Blog Posts</h2>
      <div class="searchbar">
        <form action="">
          <input type="text" placeholder="Search..." name="search" />

          <button type="submit">
            <i class="fa fa-search"></i>
          </button>

        </form>
      </div>
      <div class="categories">
        <ul>
          // show category name and linked it to category view
          <li><a href="">Health</a></li>
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

      <!-- pagination -->
      <div class="pagination" id="pagination">
          <a href="">&laquo;</a>
          <a class="active" href="">1</a>
          <a href="">2</a>
          <a href="">3</a>
          <a href="">4</a>
          <a href="">5</a>
          <a href="">&raquo;</a>
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
    };
  },
  mounted() {
    axios.get("api/posts").then((response) => {
      this.posts = response.data.data;
    });
  },
};
</script>