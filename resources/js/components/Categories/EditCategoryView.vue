<template>
    <div id="create-categories">
        <div id="contact-us">
            <h1>Edit Category!</h1>
            <div class="contact-form">
                <form @submit.prevent="submit">
                    <label for="name"><span>Category Name</span></label>
                    <!-- <input type="text" id="name" name="name" /> -->
                    <input type="text" id="name" v-model="field.name"/>
                    <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
                    <br>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <br>
                    <router-link :to="{ name: 'categoriesList' }">Categories List<span>&#8594;</span></router-link>
                </form>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    props: ['id'],
    data() {
        return {
            field: {},
            errors: {},
            success: false,
        };
    },
    methods: {
        // for updating the data
        submit() {
            axios
                .put("/api/categories/" + this.id, this.field)
                .then(() => {
                    this.field = {};
                    this.errors = {};
                    this.$router.push({ name: 'categoriesList' });
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.response.data.errors;
                });
        },
    },
    // for showing the data in the form
    mounted() {
        axios.get('/api/categories/' + this.id)
        .then((response) => {
            this.field = response.data;
        }).catch((error) => {
            console.log(error);
        });
    },
};
</script>

<style scoped>
#create-categories {
  background-color: #f3f4f6;
  height: 90vh;
  padding: 50px;
}
</style>