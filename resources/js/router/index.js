import {createRouter, createWebHistory} from 'vue-router'


const routes = [
        {
            path: '/',
            name: 'home',
            component: () => import('../components/HomeView.vue'),
            meta: {
                title: 'Home'
            }
        },
        {
            path: '/about',
            name: 'about',
            component: () => import('../components/AboutView.vue'),
            meta: {
                title: 'About'
            }
        },
        {
            path: '/blog',
            name: 'blog',
            component: () => import('../components/BlogView.vue'),
            meta: {
                title: 'Blog'
            }
        },
        {
            path: '/contact',
            name: 'contact',
            component: () => import('../components/ContactView.vue'),
            meta: {
                title: 'Contact'
            }
        },  
        {
            path: '/blog/:slug',
            name: 'single-blog',
            component: () => import('../components/SingleBlogView.vue'),
            meta: {
                title: 'Single Blog'
            },
            props: true
        }, 
        {
            path: '/login',
            name: 'login',
            component: () => import('../components/LoginView.vue'),
            meta: {
                title: 'Login',
                requiresVisitor: true
            },
        }, 
        {
            path: '/register',
            name: 'register',
            component: () => import('../components/RegisterView.vue'),
            meta: {
                title: 'Register',
                requiresVisitor: true
            },
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: () => import('../components/DashboardView.vue'),
            meta: {
                title: 'Dashboard',
                requiresAuth: true
            },
        },
        {
            path: '/categories/create',
            name: 'create-category',
            component: () => import('../components/Categories/CreateCategoryView.vue'),
            meta: {
                title: 'Create Category',
                requiresAuth: true
            }, 
        },
        {
            path: '/categories',
            name: 'categoriesList',
            component: () => import('../components/Categories/CategoriesListView.vue'),
            meta: {
                title: 'Categories List',
                requiresAuth: true
            }, 
        },
        {
            path: '/categories/:id/edit',
            name: 'edit-category',
            component: () => import('../components/Categories/EditCategoryView.vue'),
            meta: {
                title: 'Edit Category',
                requiresAuth: true
            },
            props: true 
        },
        {
            path: '/posts/create',
            name: 'create-post',
            component: () => import('../components/Posts/CreatePostView.vue'),
            meta: {
                title: 'Create Post',
                requiresAuth: true
            },
        },


    ]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to) => {
   const authentecated = localStorage.getItem('authentcated');

    if(authentecated && to.meta.requiresVisitor){
        return({name: 'dashboard'})
    }else if(!authentecated && to.meta.requiresAuth){
        return({name: 'login'})
    }
})


const DEFAULT_NAME = 'Blog SPA'
router.afterEach((to)=>{
    document.title = to.meta.title || DEFAULT_NAME
})



export default router