<template>
    <div>
        <!-- header -->
        <header class="header">
                <div class="header-text">
                    <h1>Alphayo Blog</h1>
                    <h4>Home of verified news...</h4>
                </div>
                <div class="overlay"></div>
        </header>
        
        <h2 class="header-title">Latest Blog Posts</h2>
        <section class="cards-blog latest-blog">
            
            <div class="card-blog-content">
                <img src="@/assets/images/pic1.jpg" alt="" />
                <p>
                    2 hours ago
                    <span style="float: right">Written By Alphayo Wakarindi</span>
                </p>
                <h4 style="font-weight: bolder">
                    <router-link :to="{name:'single-blog' ,params:{slug:'Benefits-of-Getting-Covid-19-Vaccination'}}">Benefits of Getting Covid 19 Vaccination</router-link>
                </h4>
            </div>

            <div class="card-blog-content">
                <img src="@/assets/images/pic2.jpg" alt="" />
                <p>
                    23 hours ago
                    <span style="float: right">Written By Alphayo Wakarindi</span>
                </p>
                <h4 style="font-weight: bolder">
                    <router-link :to="{name:'single-blog' ,params:{slug:'sd'}}">Top 10 Music Stories Never Told</router-link>
                </h4>
            </div>

            <div class="card-blog-content">
                <img src="@/assets/images/pic3.jpg" alt="" />
                <p>
                    2 days ago
                    <span style="float: right">Written By Alphayo Wakarindi</span>
                </p>
                <h4 style="font-weight: bolder">
                    <router-link :to="{name:'single-blog' ,params:{slug:'sd'}}">WRC Safari Rally Back To Kenya After 19 Years</router-link>
                </h4>
            </div>

            <div class="card-blog-content">
                <img src="@/assets/images/pic4.jpg" alt="" />
                <p>
                    3 days ago
                    <span style="float: right">Written By Alphayo Wakarindi</span>
                </p>
                <h4 style="font-weight: bolder">
                    <router-link :to="{name:'single-blog' ,params:{slug:'sdd'}}">Premier League 2021/2022 Fixtures</router-link>
                </h4>
            </div>
        </section>
    </div>
</template>