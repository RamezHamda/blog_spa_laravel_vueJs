<template>
    <main class="edit-post">
        <div class="container">
            <h1>Edit Posts!</h1>
            <!-- success message -->
            <div class="success-msg" v-if="success">
                <i class="fa fa-check"></i>
                Post edited successfully
            </div>
            <!-- Contact Form -->
            <div class="contact-form">
                <form @submit.prevent="submit">
                    <!-- Title -->
                    <label for="title"><span>Title</span></label>
                    <input type="text" id="title" v-model="field.title" />
                    <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
                    <br />

                    <!-- Image -->
                    <label for="image"><span>Image</span></label>
                    <!-- <input type="file" id="image" @input="getFile" />
                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                    <div class="preview">
                        <img :src="url" alt="" />
                    </div> -->

                    <input type="file" id="image" @input="getFile" />
                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                    <div class="preview">
                        <img :src="url" alt="" />
                    </div>

                    <br />

                    <!-- Drop down -->
                    <label for="categories"><span>Choose a category:</span></label>
                    <select v-model="field.category_id" id="categories">
                        <option disabled value="">Select option</option>
                        <option :value="category.id" v-for="category in categories" >
                            {{ category.name }}
                        </option>
                    </select>
                    <span v-if="errors.category_id" class="error">{{
                        errors.category_id[0]
                    }}</span>
                    <br />

                    <!-- Body-->
                    <label for="body"><span>Body</span></label>
                    <textarea id="body" v-model="field.body"></textarea>
                    <span v-if="errors.body" class="error">{{ errors.body[0] }}</span>
                    <!-- Button -->
                    <input class="add-post-btn" type="submit" value="Submit" />
                </form>
            </div>
        </div>
    </main>
</template>
  
<script>
import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
            field: {
                title: "",
                body: "",
                category_id: "",
                file: "",
            },
            errors: {},
            success: false,
            url: "",
            categories: [],
        };
    },
    methods: {
        // for updating the data
        // submit() {
        //     axios
        //         .put("/api/posts/" + this.id, this.field, {
        //             headers: {
        //                 "Content-Type": "multipart/form-data",
        //             },
        //         })
        //         .then(() => {
        //             this.field = {};
        //             this.errors = {};
        //             this.$router.push({ name: 'postsList' });
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //             this.errors = error.response.data.errors;
        //         });
        // },

        submit(){
            let fd= new FormData();
            fd.append('title', this.field.title);
            fd.append('body', this.field.body);
            fd.append('category_id', this.field.category_id);
            fd.append('file', this.field.file);
            axios.put('/api/posts/' + this.id, fd)
            .then((response) => {
                this.field = {};
                this.errors = {};
                this.$router.push({ name: 'postsList' });
            }).catch((error) => {
                console.log(error);
                this.errors = error.response.data.errors;
            });
        },

        getFile(event) {
            console.log(event.target.files[0]);
            const file = event.target.files[0];
            this.field.file = file;
            this.url = URL.createObjectURL(file);
            URL.revokeObjectURL(file);
        },
    },
    // for showing the data in the form
    mounted() {
        axios.get('/api/posts/' + this.id)
        .then((response) => {
            this.field = response.data.data;
            this.url = "/" +response.data.data.imagePath;
        }).catch((error) => {
            console.log(error);
        });

        axios.get('/api/categories')
        .then((response) => {
            console.log(response.data);
            this.categories = response.data;
        }).catch((error) => {
            console.log(error);
        });
    },
};
</script>

<style scoped>
.edit-post {
    background-color: #fff;
    padding: 0 3vw;
}

.container input,
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 20px;
    font-size: 16px;
}

h1 {
    text-align: center;
    padding: 60px 0 50px 0;
}

.add-post-btn {
    background-color: black;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.3s ease;
}

.add-post-btn:hover {
    transform: translateY(-4px);
}

.preview img {
    max-width: 100%;
    max-height: 120px;
}
</style>