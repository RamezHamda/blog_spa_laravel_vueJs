<template>
    <div id="create-categories">
        <div id="contact-us">
            <h1>Create New Category!</h1>
            <!-- success message -->
            <div class="success-msg" v-if="success">
                <i class="fa fa-check"></i>
                Category created successfully
            </div>
            <div class="contact-form">
                <form @submit.prevent="submit">
                    <label for="name"><span>Category Name</span></label>
                    <!-- <input type="text" id="name" name="name" /> -->
                    <input type="text" id="name" v-model="field.name" />
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
    data() {
        return {
            field: {},
            errors: {},
            success: false,
        };
    },
    methods: {
        submit() {
            axios
                .post("/api/categories/create", this.field)
                .then(() => {
                    this.field = {};
                    this.errors = {};
                    this.success = true;
                    this.$router.push({ name: 'categoriesList' });
                    
                    setInterval(() => {
                        this.success = false;
                    }, 1000);
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.response.data.errors;
                });
        },
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