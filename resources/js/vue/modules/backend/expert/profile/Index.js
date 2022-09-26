require('@/shared/bootstrap');

// Vue
import Vue from 'vue';
window.Vue = Vue;

// Axios Interceptors
require('vue-axios-interceptors');

// Axios, Vue-Axios
import VueAxios from 'vue-axios';
import axios from 'axios';
window.axios = require('axios');
Vue.use(VueAxios, axios);

// Vue axios defaults
Vue.axios.defaults.withCredentials = false;

import Notification from "@/shared/components/ui/misc/Notification.vue";
Vue.component('notification', Notification);

// Vuex store
import store from '@/shared/config/store';

// Component
Vue.component('expert-profile', require('@//modules/backend/expert/profile/Index.vue').default);

// Mount
if (document.getElementById("app-profile")) {
  const app = new Vue({store}).$mount('#app-profile');
}