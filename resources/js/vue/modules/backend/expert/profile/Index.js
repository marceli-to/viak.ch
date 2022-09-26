require('@/shared/bootstrap');

// Vuex store
import store from '@/shared/config/store';

// Component
Vue.component('expert-profile', require('@//modules/backend/expert/profile/Index.vue').default);

// Mount
if (document.getElementById("app-profile")) {
  const app = new Vue({store}).$mount('#app-profile');
}