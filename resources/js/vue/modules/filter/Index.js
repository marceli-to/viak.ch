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

// Vuex store
import store from '@/shared/config/store';

// Component
Vue.component('course-filter', require('@/modules/filter/Index.vue').default);

// Mount
if (document.getElementById("app-courses")) {
  const app = new Vue({store}).$mount('#app-courses');
}