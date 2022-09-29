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
import studentRoutes from '@/backend/student/config/routes';

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
import AppComponent from '@/backend/student/App.vue';

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