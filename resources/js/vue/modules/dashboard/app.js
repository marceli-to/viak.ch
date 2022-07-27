require('@/shared/bootstrap');

window._ = require('lodash');

// Vue
window.Vue = require('vue');

// Axios Interceptors
require('vue-axios-interceptors');

// Axios, Vue-Axios
import VueAxios from 'vue-axios';
import axios from 'axios';
window.axios = require('axios');
Vue.use(VueAxios, axios);

// Filters
require('@/shared/mixins/Filters');

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

// Routes
import baseRoutes from '@/shared/config/routes';
import dashboardRoutes from '@/modules/dashboard/config/routes';
import courseRoutes from '@/modules/dashboard/views/course/config/routes';
import studentRoutes from '@/modules/dashboard/views/student/config/routes';
import expertRoutes from '@/modules/dashboard/views/expert/config/routes';

const router = new VueRouter(
  { 
    mode: 'history', 
    routes: [
      ...baseRoutes,
      ...dashboardRoutes,
      ...courseRoutes,
      ...studentRoutes,
      ...expertRoutes
    ]
  }
);


// App component
import AppComponent from '@/modules/dashboard/App.vue';

// Mount App
if (document.getElementById("app")) {
  const app = new Vue({
    mixins: [],
    components: { 
      AppComponent
    },
    router,
    store
  }).$mount('#app');
}