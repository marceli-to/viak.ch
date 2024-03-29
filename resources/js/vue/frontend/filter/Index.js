require('@/shared/bootstrap');

// Component
Vue.component('course-filter', require('@/frontend/filter/Index.vue').default);

// Vuex store
import store from '@/shared/config/store';

// Interceptor
import Interceptor from "@/shared/mixins/Interceptor";

// Mount
if (document.getElementById("app-courses")) {
  const app = new Vue({
    mixins: [Interceptor],
    store
  }).$mount('#app-courses');
}