<template>
     <!-- main -->
     <main class="container">
      <section class="single-blog-post">
        <h1>{{ post.title }}</h1>

        <p class="time-and-author">
          {{ post.created_at }}
          <span>Written By {{ post.user }}</span>
        </p>

        <div class="single-blog-post-ContentImage" data-aos="fade-left">
          <img :src="`/${post.imagePath}`" alt="" />
        </div>

        <div class="about-text">
          <p>{{ post.body }}</p>
        </div>
      </section>
      <section class="recommended">

        <p>Related</p>
        <div class="recommended-cards">
      
            <router-link v-for="post in posts" :to="{name:'single-blog' ,params:{slug: post.slug}}">
              <div class="recommended-card">
                <img :src="`/${post.imagePath}`"  />
                <h4>
                  {{ post.title  }}
                </h4>
              </div>
           </router-link>

        </div>
      </section>
    </main>

</template>

<script>
  export default{
    props: ['slug'],
    data() {
      return {
        post: {},
        posts: [],
      }
    },

    mounted() {
      axios.get(`/api/posts/${this.slug}`)
      .then((response) => {
        this.post = response.data.data
      }).catch((error) => {
        console.log(error);
      });

      axios.get(`/api/related-posts/${this.slug}`)
      .then((response) => {
        this.posts = response.data.data
      }).catch((error) => {
        console.log(error);
      });
    }
  }
</script>