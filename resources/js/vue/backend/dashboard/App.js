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
import dashboardRoutes from '@/backend/dashboard/config/routes';
import courseRoutes from '@/backend/dashboard/views/course/config/routes';
import studentRoutes from '@/backend/dashboard/views/student/config/routes';
import expertRoutes from '@/backend/dashboard/views/expert/config/routes';
import adminRoutes from '@/backend/dashboard/views/admin/config/routes';
import settingRoutes from '@/backend/dashboard/views/setting/config/routes';
import discountCodeRoutes from '@/backend/dashboard/views/discount/config/routes';
import teamMemberRoutes from '@/backend/dashboard/views/team_member/config/routes';
import newsRoutes from '@/backend/dashboard/views/news/config/routes';
import heroRoutes from '@/backend/dashboard/views/hero/config/routes';
import homeLayoutRoutes from '@/backend/dashboard/views/home/config/routes';
import backofficeRoutes from '@/backend/dashboard/views/backoffice/config/routes';

const router = new VueRouter(
  { 
    mode: 'history', 
    routes: [
      ...baseRoutes,
      ...dashboardRoutes,
      ...courseRoutes,
      ...studentRoutes,
      ...expertRoutes,
      ...adminRoutes,
      ...settingRoutes,
      ...discountCodeRoutes,
      ...teamMemberRoutes,
      ...newsRoutes,
      ...heroRoutes,
      ...homeLayoutRoutes,
      ...backofficeRoutes
    ]
  }
);

// Interceptor
import Interceptor from "@/shared/mixins/Interceptor";

// App component
import AppComponent from '@/backend/dashboard/App.vue';

// Mount App
if (document.getElementById("app")) {
  const app = new Vue({
    mixins: [Interceptor],
    components: { 
      AppComponent
    },
    router,
    store
  }).$mount('#app');
}