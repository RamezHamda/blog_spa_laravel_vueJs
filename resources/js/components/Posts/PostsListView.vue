<template>
    <div class="posts-list">
        <h1>Posts List</h1>
        <div class="success-msg" v-if="editSuccess">
            <i class="fa fa-check"></i>
            Post edited successfully
        </div>
        <!-- deleted message -->
        <div class="success-msg" v-if="deleted">
                <i class="fa fa-check"></i>
               Deleted Post successfully
        </div>

        <table class="table table-striped">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">user Name</th>
                    <th scope="col">category_id</th>
                    <th scope="col">category_name</th>
                    <th scope="col">body</th>
                    <th scope="col" colspan="2">actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in items" :key="item.id">
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ item.title }}</td>
                    <td>{{ item.user }}</td>
                    <td>{{ item.category_id }}</td>
                    <td>{{ item.category_name}}</td>
                    <td>{{ item.body }}</td>
                    <td>
                        <router-link :to="{name:'edit-post', params:{slug:item.slug}}" class="btn btn-info">Edit</router-link>
                    </td>
                    <td>
                        <button class="btn btn-danger" @click="deletePost(item.id)">Delete</button>
                    </td>
                </tr>
              
            </tbody>
        </table>

        <router-link class="btn btn-primary flex-center" :to="{ name: 'create-post' }">Create Posts<span>&#8594;</span></router-link>
    </div>
</template>
  
<script>
// import useStore from "../../stores/store";
// export const store = useStore();
export default {
    props: ["editSuccess"],
    emits: ["updateSidebar"],
    data() {
        return {
            items: [],
            errors: {},
            success: false,
            deleted: false,
        };
    },
    methods: {
        getPosts() {
            axios.get('/api/posts')
                .then(response => {
                    this.items = response.data.data

                })
                .catch(error => {
                    console.log(error);
                })
        },

        deletePost(id) {
            axios.delete('/api/posts/' + id)
                .then(response => {
                    this.deleted = true;
                    setTimeout(() => {
                        this.deleted = false;
                        this.getPosts()
                        
                    }, 500);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    
    mounted() {
        this.getPosts()
    }
};
</script>
  
<style scoped>
.posts-list {
    min-height: 100vh;
    background: #fff;
}

.posts-list h1 {
    font-weight: 300;
    padding: 50px 0 30px 0;
    text-align: center;
}

.posts-list .item {
    display: flex;
    justify-content: right;
    align-items: center;
    max-width: 300px;
    margin: 0 auto !important;
}

.posts-list .item p {
    font-size: 16px;
}

.posts-list .item p,
.posts-list .item div,
.posts-list .item {
    margin: 15px 8px;
}

.posts-list .item div a {
    padding: 6px 20px;
    background-color: #4caf50;
    color: #fff;
    font-size: 14px;
    display: inline-block;
}

.posts-list .item input {
    padding: 6px 13px;
    background-color: red;
    color: #fff;
    border: none;
    font-size: 16px;
    cursor: pointer;
    font-size: 14px;
}

.posts ul li {
    list-style: none;
    background-color: #494949;
    margin: 20px 5px;
    border-radius: 15px;
}

.posts ul {
    display: flex;
    justify-content: center;
}

.posts a {
    color: white;
    padding: 10px 20px;
    display: inline-block;
}

.create-posts a,
.index-posts a {
    all: revert;
    margin: 20px 0;
    display: inline-block;
    text-decoration: none;
}

.create-posts a span,
.index-posts a span {
    font-size: 22px;
}

.index-posts {
    text-align: center;
}</style>