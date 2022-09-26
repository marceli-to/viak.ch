require('@/shared/bootstrap');

// Vue-Router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Filters
require('@/shared/mixins/Filters');

// Routes
import checkoutRoutes from '@/modules/frontend/checkout/config/routes';

const router = new VueRouter(
  { 
    mode: 'history', 
    routes: [
      ...checkoutRoutes,
    ]
  }
);

// App component
import CheckoutComponent from '@/modules/frontend/checkout/Index.vue';

// Vuex store
import store from '@/shared/config/store';

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