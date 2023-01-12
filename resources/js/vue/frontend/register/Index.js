require('@/shared/bootstrap');

// Component
Vue.component('user-register', require('@/frontend/register/Index.vue').default);

// Vuex store
import store from '@/shared/config/store';

// Interceptor
import Interceptor from "@/shared/mixins/Interceptor";

// Mount
if (document.getElementById("app-register")) {
  const app = new Vue({
    mixins: [Interceptor],
    store
  }).$mount('#app-register');
}