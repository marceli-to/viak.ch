require('@/shared/bootstrap');

// Component
Vue.component('newsletter-form', require('@/frontend/newsletter/Index.vue').default);

// Vuex store
import store from '@/shared/config/store';

// Interceptor
import Interceptor from "@/shared/mixins/Interceptor";

// Mount
if (document.getElementById("app-newsletter")) {
  const app = new Vue({
    mixins: [Interceptor],
    store
  }).$mount('#app-newsletter');
}