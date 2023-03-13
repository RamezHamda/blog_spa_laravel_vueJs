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
          <li><a href="">Health</a></li>
          <li><a href="">Entertainment</a></li>
          <li><a href="">Sports</a></li>
          <li><a href="">Nature</a></li>
        </ul>
      </div>
      <section class="cards-blog latest-blog">
        <div class="card-blog-content">
          <img src="@/assets/images/pic1.jpg" alt="" />
          <p>
            2 hours ago
            <span>Written By Alphayo Wakarindi</span>
          </p>
          <h4>
            <router-link to="/single-blog">Benefits of getting covid 19 vaccination</router-link>
          </h4>
        </div>

        <div class="card-blog-content">
          <img src="@/assets/images/pic2.jpg" alt="" />
          <p>
            23 hours ago
            <span>Written By Alphayo Wakarindi</span>
          </p>
          <h4 style="font-weight: bolder">
            <router-link to="/single-blog">Top 10 Music Stories Never Told</router-link>
          </h4>
        </div>

        <div class="card-blog-content">
          <img src="@/assets/images/pic3.jpg" alt="" />
          <p>
            2 days ago
            <span>Written By Alphayo Wakarindi</span>
          </p>
          <h4 style="font-weight: bolder">
            <router-link to="/single-blog">WRC Safari Rally Back To Kenya After 19 Years</router-link>
          </h4>
        </div>

        <div class="card-blog-content">
          <img src="@/assets/images/pic4.jpg" alt="" />
          <p>
            3 days ago
            <span>Written By Alphayo Wakarindi</span>
          </p>
          <h4 style="font-weight: bolder">
            <router-link to="/single-blog">Premier League 2021/2022 Fixtures</router-link>
          </h4>
        </div>

        <div class="card-blog-content">
          <img src="@/assets/images/pic5.jpg" alt="" />
          <p>
            2 weeks ago
            <span>Written By Alphayo Wakarindi</span>
          </p>
          <h4 style="font-weight: bolder">
            <router-link to="/single-blog">12 Health Benefits Of Pomegranate Fruit</router-link>
          </h4>
        </div>

        <div class="card-blog-content">
          <img src="@/assets/images/pic6.jpg" alt="" />
          <p>
            1 month ago
            <span>Written By Alphayo Wakarindi</span>
          </p>
          <h4 style="font-weight: bolder">
            <router-link to="/single-blog">Nairobi, The Only City In The World With A National Park</router-link>
          </h4>
        </div>

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
      </section>
    </main>
</template>