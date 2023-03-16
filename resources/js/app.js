import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue';
import { createPinia } from 'pinia'
import router from './router';
import FlashMessage from '@smartweb/vue-flash-message';

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret)


// import '@/assets/css/forms.css'
import '@/assets/css/style.css'

// axios.defaults.baseURL = 'http://localhost:8000/api';

const pinia = createPinia()
const app = createApp(App).component('font-awesome-icon', FontAwesomeIcon);

app.use(router);
app.use(pinia);
app.mount('#app');