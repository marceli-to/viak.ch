require('@/shared/bootstrap');

window._ = require('lodash');

// Filters
require('@/shared/mixins/Filters');

// Store
import store from '@/shared/config/store';

// Vue-Router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Routes
import baseRoutes from '@/shared/config/routes';
import expertRoutes from '@/backend/expert/config/routes';

const router = new VueRouter(
  { 
    mode: 'history', 
    routes: [
      ...baseRoutes,
      ...expertRoutes,
    ]
  }
);

// Interceptor
import Interceptor from "@/shared/mixins/Interceptor";

// App component
import AppComponent from '@/backend/expert/App.vue';

// Mount App
if (document.getElementById("app-user")) {
  const app = new Vue({
    mixins: [Interceptor],
    components: { 
      AppComponent,
    },
    router,
    store
  }).$mount('#app-user');
}