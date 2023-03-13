import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';
import FlashMessage from '@smartweb/vue-flash-message';

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
// import '@/assets/css/forms.css'
import '@/assets/css/style.css'

// axios.defaults.baseURL = 'http://localhost:8000/api';

const app = createApp(App);
app.use(router);
app.mount('#app');