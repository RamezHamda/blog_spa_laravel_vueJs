<template>
    <div class="categories-list">
        <h1>Categories List</h1>

        <!-- success message -->
        <div class="success-msg" v-if="success">
                <i class="fa fa-check"></i>
               Added Category successfully
        </div>
        <!-- updated message -->
        <div class="success-msg" v-if="success">
                <i class="fa fa-check"></i>
               Updated Category successfully
        </div>
        <!-- deleted message -->
        <div class="success-msg" v-if="deleted">
                <i class="fa fa-check"></i>
               Deleted Category successfully
        </div>

        <table class="table table-striped">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col" colspan="2">actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in items" :key="item.id">
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ item.name }}</td>
                    <td>
                        <router-link :to="{name:'edit-category' ,params:{id:item.id}}" class="btn btn-info">Edit</router-link>
                    </td>
                    <td>
                        <button class="btn btn-danger" @click="deleteCategory(item.id)">Delete</button>
                    </td>
                </tr>
              
            </tbody>
        </table>


        <div class="position-absolute bottom-50 end-50">
            <router-link class="btn btn-primary flex-center" :to="{ name: 'create-category' }">Create Categories<span>&#8594;</span></router-link>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            items: [],
            errors: {},
            success: false,
            deleted: false,
        };
    },
    methods: {
        getCategories() {
            axios.get('/api/categories')
                .then(response => {
                    this.items = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },

        deleteCategory(id) {
            axios.delete('/api/categories/' + id)
                .then(response => {
                    this.deleted = true;
                    this.getCategories()
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    mounted() {
        this.getCategories()
    }
};
</script>
  
<style scoped>
.categories-list {
    min-height: 100vh;
    background: #fff;
}

.categories-list h1 {
    font-weight: 300;
    padding: 50px 0 30px 0;
    text-align: center;
}

.categories-list .item {
    display: flex;
    justify-content: right;
    align-items: center;
    max-width: 300px;
    margin: 0 auto !important;
}

.categories-list .item p {
    font-size: 16px;
}

.categories-list .item p,
.categories-list .item div,
.categories-list .item {
    margin: 15px 8px;
}

.categories-list .item div a {
    padding: 6px 20px;
    background-color: #4caf50;
    color: #fff;
    font-size: 14px;
    display: inline-block;
}

.categories-list .item input {
    padding: 6px 13px;
    background-color: red;
    color: #fff;
    border: none;
    font-size: 16px;
    cursor: pointer;
    font-size: 14px;
}

.categories ul li {
    list-style: none;
    background-color: #494949;
    margin: 20px 5px;
    border-radius: 15px;
}

.categories ul {
    display: flex;
    justify-content: center;
}

.categories a {
    color: white;
    padding: 10px 20px;
    display: inline-block;
}

.create-categories a,
.index-categories a {
    all: revert;
    margin: 20px 0;
    display: inline-block;
    text-decoration: none;
}

.create-categories a span,
.index-categories a span {
    font-size: 22px;
}

.index-categories {
    text-align: center;
}</style>