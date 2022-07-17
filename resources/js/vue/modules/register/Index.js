require('@/modules/register/bootstrap');

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
Vue.component('register-form', require('@/modules/register/Index.vue').default);

// Mount
if (document.getElementById("app-register")) {
  const app = new Vue({store}).$mount('#app-register');
}