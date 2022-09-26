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

import Notification from "@/shared/components/ui/misc/Notification.vue";
Vue.component('notification', Notification);

// Store
import store from '@/shared/config/store';

// Vue-Router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Routes
import baseRoutes from '@/shared/config/routes';
import studentRoutes from '@//modules/backend/student/config/routes';

const router = new VueRouter(
  { 
    mode: 'history', 
    routes: [
      ...baseRoutes,
      ...studentRoutes,
    ]
  }
);

// App component
import AppComponent from '@//modules/backend/student/App.vue';

// Mount App
if (document.getElementById("app-student")) {
  const app = new Vue({
    mixins: [],
    components: { 
      AppComponent,
    },
    router,
    store
  }).$mount('#app-student');
}