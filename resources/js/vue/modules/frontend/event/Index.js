require('@/shared/bootstrap');

// Component
Vue.component('bookmark-button', require('@/modules/frontend/event/Bookmark.vue').default);
Vue.component('basket-button', require('@/modules/frontend/event/Basket.vue').default);

// Vuex store
import store from '@/shared/config/store';

// Mount
if (document.getElementById("app-events")) {
  const app = new Vue({store}).$mount('#app-events');
}