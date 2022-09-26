require('@/shared/bootstrap');

// Component
Vue.component('user-register', require('@/modules/frontend/register/Index.vue').default);

// Vuex store
import store from '@/shared/config/store';

// Mount
if (document.getElementById("app-register")) {
  const app = new Vue({store}).$mount('#app-register');
}