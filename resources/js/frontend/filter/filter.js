require('@frontend/filter/bootstrap');

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
import store from '@frontend/filter/config/store';

// Component
Vue.component('course-filter', require('@frontend/filter/views/Filter.vue').default);

// Mount
if (document.getElementById("app-courses")) {
  const app = new Vue({store}).$mount('#app-courses');
}