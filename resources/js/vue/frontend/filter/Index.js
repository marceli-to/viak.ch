require('@/shared/bootstrap');

// Component
Vue.component('course-filter', require('@/frontend/filter/Index.vue').default);

// Vuex store
import store from '@/shared/config/store';

// Mount
if (document.getElementById("app-courses")) {
  const app = new Vue({store}).$mount('#app-courses');
}