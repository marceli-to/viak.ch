require('@/shared/bootstrap');

// Vue
window.Vue = require('vue');

// Axios Interceptors
require('vue-axios-interceptors');

// Axios, Vue-Axios
import VueAxios from 'vue-axios';
import axios from 'axios';
window.axios = require('axios');
Vue.use(VueAxios, axios);

// Vue-Axios defaults
Vue.axios.defaults.withCredentials = true;

// Vue-Notifications
import Notifications from 'vue-notification';
Vue.use(Notifications);

// Store
import store from '@/shared/config/store';

// Vue-Router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Filters
require('@/shared/mixins/Filters');

// Routes
import checkoutRoutes from '@/modules/checkout/config/routes';

const router = new VueRouter(
  { 
    mode: 'history', 
    routes: [
      ...checkoutRoutes,
    ]
  }
);

// App component
import CheckoutComponent from '@/modules/checkout/Index.vue';

// Mount App
if (document.getElementById("app-checkout")) {
  const app = new Vue({
    mixins: [],
    components: { 
      CheckoutComponent
    },
    router,
    store
  }).$mount('#app-checkout');
}